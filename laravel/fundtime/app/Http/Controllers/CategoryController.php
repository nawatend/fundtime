<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function getIndex(Category $category)
    {
        $projects = $category->projects;
        $categories = Category::all();
       
        return view('projects.index', compact('categories', 'projects'));
    }
}
