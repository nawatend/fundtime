<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use App\Models\Pledge;
use App\Models\ProjectImage;
use App\Models\Category;
use App\Models\Backer;
use Auth;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ProjectsController extends Controller
{
    public function getIndex()
    {
        //sortByDesc Z -> A
        //sortBy
        $categories = Category::all()->sortBy("category_name");
        $projects = Project::all();
        return view('projects.index', compact('projects', 'categories'));
    }
    public function getMyProjects()
    {
        $user = Auth::user();
        //sortByDesc Z -> A
        //sortBy
        $categories = Category::all()->sortBy("category_name");
        $projects = Project::all();
        return view('projects.myprojects', compact('projects', 'categories', 'user'));
    }
    
    public function getCreate(Project $project)
    {
        return view('projects.edit', compact('project'));
    }


    public function getEdit($project_id)
    {
        $project = Project::find($project_id);
        return view('projects.edit', compact('project'));
    }
    public function getDetail($project_id)
    {
        $project = Project::find($project_id);
        $images = ProjectImage::where('project_id', $project_id)->get();
        $pledgeLegendary = Pledge::where('project_id', $project_id)->where('title', 'Legendary Pledge')->get();
        $pledgeEpic = Pledge::where('project_id', $project_id)->where('title', 'Epic Pledge')->get();
        $pledgeRare = Pledge::where('project_id', $project_id)->where('title', 'Rare Pledge')->get();
        $pledges = Pledge::where('project_id', $project_id)->get();
        $user = Auth::user();


        //dd($images);
        // check if project exists
        // if(!$project->id) abort('404');
        return view('projects.detail', compact('user', 'project', 'images', 'pledges', 'pledgeLegendary', 'pledgeEpic', 'pledgeRare'));
    }

    public function postSave()
    {
        
        //cleint id update
        $user = Auth::user();
        $project_id = (request("projectId")) ? request('projectId') : null;
        $request = request();

        $rules = [
            'project_title'         => 'required|max:255' ,
            'project_description'   => 'required' ,
            'project_target_amount' => 'required|integer',
            'project_category'      => 'required',
            'start_date'            => 'date_format:"d-m-Y"|required|before_or_equal:end_date',
            'end_date'              => 'date_format:"d-m-Y"|required|after_or_equal:start_date',
            'images'                => 'required',
            'images.*'              => 'image|mimes:jpeg,png,jpg,gif,svg|max:10048',
            'legendary_price'       => 'required|numeric',
            'epic_price'            => 'required|numeric',
            'rare_price'            => 'required|numeric',
            'legendary_info'        => 'required' ,
            'epic_info'             => 'required' ,
            'rare_info'             => 'required' ,

        ];

        //$validator = Validator::make($request->all(), $rules);
       
        // if ($validator->fails()) {
        //     return Redirect::back();
        // };
        //form validation
        request()->validate($rules);
        
        
       
        $coverImagePath = "../images/" . $request->file('images')[0]->getClientOriginalName();
        //project handles
        $dataProject = [
            'user_id'       => $user->id,
            'category_id'   => request('project_category') ,
            'title'         => request('project_title') ,
            'description'   => request('project_description') ,
            'target_amount' => request('project_target_amount'),
            'funded_amount' => 0,
            'start_date'    => request('start_date') ,
            'end_date'      => request('end_date'),
            'cover_image_path' => $coverImagePath,
        ];

        $dataProject['start_date'] = \DateTime::createFromFormat('d-m-Y', $dataProject['start_date']);
        $dataProject['end_date'] = \DateTime::createFromFormat('d-m-Y', $dataProject['end_date']);

 
        $lastEditProject = Project::UpdateOrCreate(['id' => $project_id], $dataProject);
        $currentProjectId = $lastEditProject->id;


        
        //images handles
        $data= [];
        
        if ($request->hasfile('images')) {
            foreach ($request->file('images') as $image) {
                $name=$image->getClientOriginalName();
                //image upload to images folder
                $image->move(public_path().'/images/', $name);
                //image path store in db
                $imagePath =  $name;

                $projectImageData = [
                    "project_id" => $currentProjectId,
                    "image_path" => $imagePath,
                ];
                ProjectImage::UpdateOrCreate($projectImageData);
                $data[] = $name;
            }
        }

        // dd(json_encode($data));


        //insert pledges for current project
        /**
         * l = legendary
         * e = epic
         * r = rare
         */
        $l_pledge = [
            'project_id' => $currentProjectId,
            'title' => "Legendary Pledge",
            'description' => request('legendary_info'),
            'price' => request('legendary_price'),
            'slug' => 'legendary',
        ];

        $e_pledge = [
            'project_id' => $currentProjectId,
            'title' => "Epic Pledge",
            'description' => request('epic_info'),
            'price' => request('epic_price'),
            'slug' => 'epic',
        ];

        $r_pledge = [
            'project_id' => $currentProjectId,
            'title' => "Rare Pledge",
            'description' => request('rare_info'),
            'price' => request('rare_price'),
            'slug' => 'rare',
        ];

        Pledge::UpdateOrCreate(['project_id' => $currentProjectId, 'title' => "Legendary Pledge"], $l_pledge);
        Pledge::UpdateOrCreate(['project_id' => $currentProjectId, 'title' => "Epic Pledge"], $e_pledge);
        Pledge::UpdateOrCreate(['project_id' => $currentProjectId, 'title' => "Rare Pledge"], $r_pledge);

        return redirect()->route('projects.index');
    }


    public function postFund()
    {
        $project_id = (request("project_id")) ? request('project_id') : null;
        $pledge_id = (request("pledge_id")) ? request('pledge_id') : null;
        $user = Auth::user();
        
        $project = Project::find($project_id);
        $pledge = Pledge::find($pledge_id);

        //cleint id update
       
        $total_user_f = $user->credits - $pledge->price;

        $user->credits = $total_user_f;
        $user->save();

        //create a baker
        $newBaker = [
            'project_id' => $project_id,
            'user_id' => $user->id,
            'pledge_id' => $pledge_id,
        ];
        Backer::UpdateOrCreate($newBaker);

        //add fund to project funded f's
        return view('projects.pledge_confirm', compact('project', 'pledge', 'user'));
    }
}
