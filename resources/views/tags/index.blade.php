@extends('layouts.app')　　　　　　　　　　　　　　　　　　

@section('content')
        <h1>Tag</h1>
        <div class="create">
            <a href='/posts/create'>create</a>
        </div>
        <div class='posts'>
            @foreach ($posts as $post)
              <div class='post'>
                  <h2 class='title'>
                     <a href="/posts/{{ $post->id }}">Post {{ $post->id }}</a>
                  </h2>
                     <p class='event'>{{ $post->event}}</p>
                     <p class='impression'>{{ $post->impression}}</p>
                     <p class='reaction'>{{ $post->reaction}}</p>
                  <a href="/tags/{{ $post->tag->id }}">{{ $post->tag->name }}</a>
                  <a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
              </div>
              <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post" style="display:inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit">delete</button> 
              </form>
            @endforeach
        </div>
        <div class="footer">
            <a href="/">ホームに戻る</a>
        </div>
        <div class='paginate'>
            {{ $posts->links() }}
        </div>
@endsection