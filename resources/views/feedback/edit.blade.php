@extends('layouts.app')　　　　　　　　　　　　　　　　　　

@section('content')
        <h1>フィードバック</h1>
        <div class="content">
            <form action="/posts/{{ $post->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class='event'>
                    <h4>出来事</h4>
                    <input type='text' name='post[event]' value="{{ $post->event }}" readonly>
                </div>
                <div class='impression'>
                    <h4>感想</h4>
                    <input type='text' name='post[impression]' value="{{ $post->impression }}" readonly>
                </div>
                <div class='reaction'>
                    <h4>反応</h4>
                    <input type='text' name='post[reaction]' value="{{ $post->reaction }}" readonly>
                </div>
                <div class='tag'>
                    <h4>感情タグ</h4>
                    <select name="post[tag_id]" disabled>
                        @foreach($tags as $tag)  //選択肢がダブらないようにする。foreachで並べるときに、
                            @if($post->tag->id === $tag->id)  //元の投稿$postのtagのidと同じidのタグは
                                <option value="{{ $tag->id }}" selected>{{ $tag->name }}</option>  //選択済みにする
                            @else  //それ以外は
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>  //そのまま選択肢として並べる
                            @endif
                        @endforeach
                    </select>
                    <input type="hidden" name="post[tag_id]" value="{{ $tag->id }}">
                <div class='category'>
                    <h4>内容カテゴリ</h4>
                    <select name="post[category_id]" disabled>
                         @foreach($categories as $category)
                            @if($post->category->id === $category->id)
                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                            @else
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    <input type="hidden" name="post[category_id]" value="{{ $category->id }}">
                </div>
                <div class="feedback">
                    <h3>フィードバック</h3>
                    <textarea name="post[feedback]" placeholder="振り返ってどう？">{{ $post->feedback }}</textarea>
                </div>
                <input type="submit" value="update">
            </form>
        </div>
        <div class="back">[<a href="/">ホームに戻る</a>]</div>
@endsection