<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function getIndex()
    {
        return view('projects.index');
    }
    
    public function getCreate()
    {
        return view('projects.edit');
    }
}
