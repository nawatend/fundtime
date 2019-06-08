<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Project;
use Auth;

class PagesController extends Controller
{
    public function getIndex()
    {
        $pageData = Page::where('id', 1)->first();
        $projects = Project::all();
      
        return view('pages.home')->with(compact('pageData', 'projects'));
    }

    public function getAbout()
    {
        $pageData = Page::where('id', 2)->first();
      
        return view('pages.about')->with(compact('pageData'));
    }
    public function getPrivacy()
    {
        $pageData = Page::where('id', 3)->first();
        
        return view('pages.privacy')->with(compact('pageData'));
    }
}
