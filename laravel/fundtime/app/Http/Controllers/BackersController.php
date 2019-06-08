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


use App\Mail\SendMail;
use Mail;
use App\Http\Controllers\Traits\SendMailTrait;

use Session;
use Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class BackersController extends Controller
{
    use SendMailTrait;

    public function postBacker()
    {
        $project_id = (request("project_id")) ? request('project_id') : null;
        $pledge_id = (request("pledge_id")) ? request('pledge_id') : null;
        $user = Auth::user();
        $admin = User::where('role', '=', 'admin')->firstOrFail();

       
        $project = Project::find($project_id);
        $pledge = Pledge::find($pledge_id);

        if ($user->credits >= $pledge->price) {
            //client credits update
            $total_user_f = $user->credits - $pledge->price;

            $user->credits = $total_user_f;
            $user->save();

            //project funded f's
            //commission add to admin account
            $commission = (int)($pledge->price * 0.1);
            $admin->credits += $commission;
            $admin->save();
            
            $project->funded_amount += ($pledge->price - $commission);
            $project->save();

            //create a baker
            $newBaker = [
            'project_id' => $project_id,
            'user_id' => $user->id,
            'pledge_id' => $pledge_id,
            ];

            Backer::UpdateOrCreate($newBaker);
            //send mail
            $mailData = [
                'mail_type' => 'new_fund',
                'mail_info' => 'Funded Project',
                'name' => $user->name,
                'email' => $user->email,
                'body' => "You have successfully funded project <strong>" . $project->title
                . "</strong> with " . $pledge->title . " of <strong>" . $pledge->price
                . "</strong> F's. <br> <strong>Congratulation And Thank you</strong>" ,
            ];
            $this->sendMail($mailData);

            //add fund to project funded f's

            //good page
            return view('projects.pledge_confirm', compact('project', 'pledge', 'user'));
        } else {
            Session::flash('message', "You little lady doesn't have enough credits !!!");
            return Redirect::back();
        }
    }
}
