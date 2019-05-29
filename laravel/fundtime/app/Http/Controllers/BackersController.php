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
use Session;
use Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class BackersController extends Controller
{
    public function postBacker()
    {
        $project_id = (request("project_id")) ? request('project_id') : null;
        $pledge_id = (request("pledge_id")) ? request('pledge_id') : null;
        $user = Auth::user();
        
        $project = Project::find($project_id);
        $pledge = Pledge::find($pledge_id);

        if ($user->credits >= $pledge->price) {
            //client credits update
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
        } else {
            Session::flash('message', "You little lady doesn't have enough credits !!!");
            return Redirect::back();
        }
    }
}
