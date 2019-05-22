<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function getIndex()
    {
        return view('news.index');
    }

    public function getCreate()
    {
        return view('news.edit');
    }

    public function postSave()
    {
        return view('news.index');
    }
}
