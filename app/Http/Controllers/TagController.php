<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagController extends Controller
{
    public function index(Tag $tag)
    {
        return view('tags.index')->with(['posts' => $tag->getByTag()]);
        //投稿データたち（posts）の$categoryインスタンスをgetBy~で数絞ってcategories下のindexというviewに返す
    }
}
