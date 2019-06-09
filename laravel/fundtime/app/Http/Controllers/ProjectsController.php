<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\User;
use App\Models\Pledge;
use App\Models\ProjectImage;
use App\Models\Category;
use App\Models\CategoryProject;
use App\Models\Backer;
use App\Models\Comment;

use Auth;
use Session;

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

        //check for outdated promotion
        foreach ($projects as $project) {
            if ($project->promotion_start_date != null) {
                $promotion_end_date = strtotime("+1 week", strtotime($project->promotion_start_date));
                $currentDate =  strtotime(date("Y-m-d"));
                if ($currentDate > $promotion_end_date) {
                    $project->promotion_start_date = null;
                    $project->save();
                }
            }
        }
        
        return view('projects.index', compact('projects', 'categories'));
    }
    public function getMyProjects()
    {
        $user = Auth::user();
        //sortByDesc Z -> A
        //sortBy
        $categories = Category::all()->sortBy("category_name");
        $projects = Project::where('user_id', $user->id)->get();
        
        //check for outdated promotion
        foreach ($projects as $project) {
            if ($project->promotion_start_date != null) {
                $promotion_end_date = strtotime("+1 week", strtotime($project->promotion_start_date));
                $currentDate =  strtotime(date("Y-m-d"));
                if ($currentDate > $promotion_end_date) {
                    $project->promotion_start_date = null;
                    $project->save();
                }
            }
        }
        
        return view('projects.myprojects', compact('projects', 'categories', 'user'));
    }
    
    public function getCreate(Project $project, Pledge $pledge)
    {
        $user = Auth::user();
        $categories = Category::all();
        $pledges = [$pledge,$pledge,$pledge];
        
        return view('projects.edit', compact('user', 'project', 'pledges', 'categories'));
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
    public function getDetail($project_id, Comment $comment)
    {
        $project = Project::find($project_id);
        $images = ProjectImage::where('project_id', $project_id)->get();
        $pledgeLegendary = Pledge::where('project_id', $project_id)->where('title', 'Legendary Pledge')->get();
        $pledgeEpic = Pledge::where('project_id', $project_id)->where('title', 'Epic Pledge')->get();
        $pledgeRare = Pledge::where('project_id', $project_id)->where('title', 'Rare Pledge')->get();
        $pledges = Pledge::where('project_id', $project_id)->get();
        $user = Auth::user();

        $comments = DB::table('comments')
        ->where('project_id', $project_id)
        ->join('users', 'comments.user_id', '=', 'users.id')
        ->orderBy('comments.created_at', 'DESC')->paginate(5);
     
        $backers = DB::table('backers')
        ->join('users', 'backers.user_id', '=', 'users.id')
        ->join('pledges', 'backers.pledge_id', '=', 'pledges.id')
        ->get();
        //dd($images);
        // check if project exists
        // if(!$project->id) abort('404');

        $funded_perc = 0;
        $not_funded_perc = 0;

        if ($project->funded_amount >= 0) {
            $funded_perc = round($project->funded_amount / $project->target_amount * 100, 2);
            $not_funded_perc = round(100 - $funded_perc, 2);
            if ($not_funded_perc < 0) {
                $not_funded_perc = 0;
            }
        }
        
        //dd($funded_perc . " - " . $not_funded_perc);
        
        return view('projects.detail', compact('funded_perc', 'not_funded_perc', 'comments', 'comment', 'backers', 'user', 'project', 'images', 'pledges', 'pledgeLegendary', 'pledgeEpic', 'pledgeRare'));
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

    public function getPromote($project_id, $layer_id)
    {
        $currentUser = Auth::user();
        $project = Project::find($project_id);
        $admin = User::where('role', "=", 'admin')->firstOrFail();
        
        // dd($admin->name);
        switch ($layer_id) {
            case 0:
                $project->promotion_start_date = null;
                $project->layer = 0;
                break;
            case 1:
                if ($currentUser->credits >= 700) {
                    $currentUser->credits = $currentUser->credits - 700;
                    
                    $project->layer = $layer_id;
                    $project->promotion_start_date = date("Y-m-d");
                    $admin->credits += 700;
                    $admin->save();
                    $currentUser->save();
                } else {
                    Session::flash('message', "You little lady, doesn't have enough credits !!!");
                    return Redirect::back();
                }
                break;
            
            case 2:
                if ($currentUser->credits >= 500) {
                    $currentUser->credits = $currentUser->credits - 500;
                    $project->layer = $layer_id;
                    $project->promotion_start_date = date("Y-m-d");

                    $admin->credits += 500;
                    $admin->save();
                    $currentUser->save();
                } else {
                    Session::flash('message', "You little lady, doesn't have enough credits !!!");
                    return Redirect::back();
                }
                break;
            case 3:
                if ($currentUser->credits >= 300) {
                    $currentUser->credits = $currentUser->credits - 300;
                    $project->layer = $layer_id;
                    $project->promotion_start_date = date("Y-m-d");

                    $admin->credits += 300;
                    $admin->save();
                    $currentUser->save();
                } else {
                    Session::flash('message', "You little lady, doesn't have enough credits !!!");
                    return Redirect::back();
                }
                break;
            default:
                # code...
                break;
        }

        $project->save();
        return redirect()->route('pages.home');
    }

    public function destroy($project_id)
    {
        $project = Project::find($project_id);
        $currentUser = User::find($project->user_id);
        //all f's earn goes to account
        $currentUser->credits += $project->funded_amount;
        $currentUser->save();
        

        $project->delete();
     
        return redirect()->route('projects.index');
    }
}
