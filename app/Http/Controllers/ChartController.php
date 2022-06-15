<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request; 
use App\Category;
use App\Tag;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function categories(Post $post, Category $category){
          
        $aboutmecount = DB::table('posts')->where('category_id','1')->where('deleted_at',NULL)->count();
        //   dd($aboutmecount);
        $aroundmecount = DB::table('posts')->where('category_id','2')->where('deleted_at',NULL)->count();
        $aboutsocialcount = DB::table('posts')->where('category_id','3')->where('deleted_at',NULL)->count();
          return view("chart/categories")->with([
              'aboutmecount' => $aboutmecount,
              'aroundmecount' => $aroundmecount,
              'aboutsocialcount' => $aboutsocialcount]);
    }
}
