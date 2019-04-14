<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function getIndex()
    {
        return view('profile.index');
    }

    public function getEdit()
    {
        return view('news.index');
    }
}
