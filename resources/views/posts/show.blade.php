@extends('layouts.app')　　　　　　　　　　　　　　　　　　

@section('content')
        <h1>Introspect</h1>
        <div class="create">
            <p class="edit">[<a href="/posts/{{ $post->id }}/edit">edit</a>]</p>
        </div>
            <div class='post'>
                <h2 class='title'>
                    <a>Post {{ $post->id }} 詳細</a>
                </h2>
                <h3>出来事</h3>
                    <p class='event'>{{ $post->event}}</p>
                <h3>感想</h3>
                    <p class='impression'>{{ $post->impression}}</p>
                <h3>反応</h3>
                    <p class='reaction'>{{ $post->reaction}}</p>
                <h3>感情タグ</h3>
                    <a href="/tags/{{ $post->tag->id }}">{{ $post->tag->name }}</a>
                <h3>内容カテゴリ</h3>
                    <a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
                <h3>フィードバック</h3>
                    <p class='feedback'>{{ $post->feedback}}</p>
              </div>
        <div class="footer">
            <a href="/">ホームに戻る</a>
        </div>
        <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post" style="display:inline">
            @csrf
            @method('DELETE')
            <button type="button" onclick='deletePost();'>delete</button> 
        </form>
        <script>
            function deletePost(){
                'use strict';
                if (confirm('記事を削除しますか？')) {
                    document.getElementById('form_{{ $post->id }}').submit();
                }
            }
        </script>
@endsection