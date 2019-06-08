<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use PDF;

use App\Models\Project;
use App\Models\User;
use App\Models\Pledge;
use App\Models\ProjectImage;
use App\Models\Category;
use App\Models\CategoryProject;
use App\Models\Backer;
use App\Models\Comment;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('auth.login');
    }

    public function generatePDF($project_id)
    {
        $project = Project::find($project_id);
        $images = ProjectImage::where('project_id', $project_id)->get();
        $pledgeLegendary = Pledge::where('project_id', $project_id)->where('title', 'Legendary Pledge')->get();
        $pledgeEpic = Pledge::where('project_id', $project_id)->where('title', 'Epic Pledge')->get();
        $pledgeRare = Pledge::where('project_id', $project_id)->where('title', 'Rare Pledge')->get();
        $pledges = Pledge::where('project_id', $project_id)->get();
       

       
        $backers = DB::table('backers')
        ->join('users', 'backers.user_id', '=', 'users.id')
        ->join('pledges', 'backers.pledge_id', '=', 'pledges.id')
        ->get();

        
        $data = [
            'project'         => $project,
            'images'          => $images,
            'pledges'         => $pledges,
            'pledgeLegendary'=> $pledgeLegendary,
            'pledgeEpic'      => $pledgeEpic,
            'pledgeRare'      => $pledgeRare,
            'backers' => $backers,
    
        ];

        // $data = ['title' => 'Welcome to HDTuto.com'];
        // $pdf = PDF::loadView('pdf', $data);
  
        // return $pdf->download('itsolutionstuff.pdf');
       
        $pdf = PDF::loadView('pdf', $data);
       
        return $pdf->download($project->title .'.pdf');
        //  return view('pdf', compact('backers', 'project', 'images', 'pledges', 'pledgeLegendary', 'pledgeEpic', 'pledgeRare'));
    }
}
