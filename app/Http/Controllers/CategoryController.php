<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function index(Category $category)
    {
        return view('categories.index')->with(['posts' => $category->getByCategory()]);
        //投稿データたち（posts）の$categoryインスタンスをgetBy~で数絞ってcategories下のindexというviewに返す
    }
}
