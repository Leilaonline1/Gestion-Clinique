<?php

namespace App\Http\Controllers;
use App\Models\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create()
{
    $categories = Category::all();
    return view('backend.analyses.create-analyse', compact('categories'));
}
}
