<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class CustomController extends Controller
{
    //

    public function index(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }
}
