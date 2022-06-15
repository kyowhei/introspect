<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request; 
use App\Category;
use App\Tag;

class PostController extends Controller
{
    // 投稿一覧表示
    public function index(Post $post, Category $category, Tag $tag)
    {
        return view('posts/index')->with([
            'posts' => $post->getPaginateByLimit(),//'posts'はviewで$postsに入る
            'categories' => $category->get(),
            'tags' => $tag->get()
            ]);
    }
     
 //特定IDのpostを表示する.引数の$postはid=1のPostインスタンス
    public function show(Post $post)
    {
        return view('posts/show')->with(['post' => $post]);
    }
   
    public function create(Category $category, Tag $tag)
    {
        return view('posts/create')->with([
            'categories' => $category->get(),
            'tags' => $tag->get()
            ]);  //カテゴリーのすべてのデータをcreate.blade.phpに渡す
    }
   
    public function store(PostRequest $request, Post $post)
    {
        $input = $request['post'];
        $input += ['user_id' => $request->user()->id];
        $post->fill($input)->save();
        return redirect('/posts/' . $post->id);
    }
   
    public function edit(Post $post, Category $category, Tag $tag)
    {
        return view('posts/edit')->with([
            'post' => $post,
            'categories' => $category->get(),
            'tags' => $tag->get()
            ]);
    }
   
    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        $input += ['user_id' => $request->user()->id];
        $post->fill($input_post)->save();
        return redirect('/posts/' . $post->id);
    }
    
     public function fb_edit(Post $post, Category $category, Tag $tag)
    {
        return view('feedback/edit')->with([
            'post' => $post,
            'categories' => $category->get(),
            'tags' => $tag->get()
            ]);
    }
    
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
}
