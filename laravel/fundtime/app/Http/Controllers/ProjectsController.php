<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use App\Models\Pledge;
use App\Models\ProjectImage;
use App\Models\Category;
use App\Models\CategoryProject;
use App\Models\Backer;
use Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ProjectsController extends Controller
{
    public function getIndex(Category $category = null)
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
    
    public function getCreate(Project $project, Pledge $pledge)
    {
        $categories = Category::all();
        $pledges = [$pledge,$pledge,$pledge];
        return view('projects.edit', compact('project', 'pledges', 'categories'));
    }


    public function getEdit($project_id)
    {
        $categories = Category::all();
        $project = Project::find($project_id);
        $pledges = Pledge::where('project_id', $project_id)->get();
      

        $start_date = $project->getStartDateByFormat('Y-m-d');
        $end_date = $project->getEndDateByFormat('Y-m-d');

        return view('projects.edit', compact('project', 'pledges', 'categories'));
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

        $backers = DB::table('backers')
        ->join('users', 'backers.user_id', '=', 'users.id')
        ->join('pledges', 'backers.pledge_id', '=', 'pledges.id')
        ->get();
        //dd($images);
        // check if project exists
        // if(!$project->id) abort('404');
    
        
        return view('projects.detail', compact('backers', 'user', 'project', 'images', 'pledges', 'pledgeLegendary', 'pledgeEpic', 'pledgeRare'));
    }

    public function postSave()
    {
        
        //cleint id update
        $user = Auth::user();
        $project_id = (request("project_id")) ? request('project_id') : null;
        $request = request();

        $rules = [
            'project_title'         => 'required|max:200' ,
            'project_intro' => 'required|max:400',
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
            'intro' => request('project_intro'),
            'description'   => request('project_description') ,
            'target_amount' => request('project_target_amount'),
            'funded_amount' => 0,
            'start_date'    => request('start_date') ,
            'end_date'      => request('end_date'),
            'cover_image_path' => $coverImagePath,
        ];

        $dataProject['start_date'] = \DateTime::createFromFormat('d-m-Y', $dataProject['start_date']);
        $dataProject['end_date'] = \DateTime::createFromFormat('d-m-Y', $dataProject['end_date']);

        
        //last added project id
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

        // projects and categories relations
        $categoryProject = [
            'project_id'   => $currentProjectId ,
            'category_id'   => request('project_category'),
        ];
        CategoryProject::UpdateOrCreate(['project_id' => $currentProjectId], $categoryProject);



        //insert pledges for current project
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


    public function destroy($project_id)
    {
        $project = Project::find($project_id);
        
        $project->delete();
        
        return redirect()->route('projects.index');
    }
}
