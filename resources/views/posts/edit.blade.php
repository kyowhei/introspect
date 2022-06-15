@extends('layouts.app')　　　　　　　　　　　　　　　　　　

@section('content')
        <h1>Edit Mode</h1>
        <div class="content">
            <form action="/posts/{{ $post->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class='event'>
                    <h3>出来事</h3>
                    <input type='text' name='post[event]' value="{{ $post->event }}">
                </div>
                <div class='impression'>
                    <h3>感想</h3>
                    <input type='text' name='post[impression]' value="{{ $post->impression }}">
                </div>
                <div class='reaction'>
                    <h3>反応</h3>
                    <input type='text' name='post[reaction]' value="{{ $post->reaction }}">
                </div>
                <div class='tag'>
                    <h3>感情タグ</h3>
                    <select name="post[tag_id]">
                        @foreach($tags as $tag)  //選択肢がダブらないようにする。foreachで並べるときに、
                            @if($post->tag->id === $tag->id)  //元の投稿$postのtagのidと同じidのタグは
                                <option value="{{ $tag->id }}" selected>{{ $tag->name }}</option>  //選択済みにする
                            @else  //それ以外は
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>  //そのまま選択肢として並べる
                            @endif
                        @endforeach
                    </select>
                 <div class='category'>
                    <h3>内容カテゴリ</h3>
                    <select name="post[category_id]">
                         @foreach($categories as $category)
                            @if($post->category->id === $category->id)
                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                            @else
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <input type="submit" value="update">
            </form>
        </div>
        <div class="back">[<a href="/posts/{{ $post->id }}">投稿詳細へ</a>]</div>
        <div class="back">[<a href="/">ホームに戻る</a>]</div>
@endsection