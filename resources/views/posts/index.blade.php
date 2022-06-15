@extends('layouts.app')　　　　　　　　　　　　　　　　　　

@section('content')
        <p class='username'>ログイン中：{{ Auth::user()->name }}</p>
        
        <div class="create">
            <form action="/posts" method="POST">
                @csrf
                <h2 class='title'>新規作成</h2>
                <div class="event">
                    <h4>出来事</h4>
                    <textarea name="post[event]" placeholder="何があった？">{{ old('post.event') }}</textarea>
                </div>
                <div class="impression">
                    <h4>感想</h4>
                    <textarea name="post[impression]" placeholder="どう思った？">{{ old('post.impression') }}</textarea>
                </div>
                <div class="reaction">
                    <h4>反応</h4>
                    <textarea name="post[reaction]" placeholder="どう反応した？">{{ old('post.reaction') }}</textarea>
                </div>
                <div class="tag">
                    <h4>感情タグ</h4>
                    <select name="post[tag_id]">
                        <option disabled selected>選択してください</option>
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                        //$tagsにはタグーの全件データが入っているので、それを１件ずつ表示。
                        //実際に送信したい値はタグのidなので、valueには各タグのidを設定。
                    </select>
                    <p class="tag__error" style="color:red">{{ $errors->first('post.tag_id') }}</p>
                </div>
                <div class="category">
                    <h4>内容カテゴリ</h4>
                    <select name="post[category_id]">
                        <option disabled selected>選択してください</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                        //$categoriesにはカテゴリーの全件データが入っているので、それを１件ずつ表示。
                        //実際に送信したい値はカテゴリーのidなので、valueには各カテゴリーのidを設定。
                    </select>
                    <p class="category__error" style="color:red">{{ $errors->first('post.category_id') }}</p>
                </div>
                <input type="submit" value="store"/>
            </form>
        </div>
        
        <div class='chart'>
            <a href='/chart/categories'>カテゴリーCHART</a>
        </div>
        
        <div class='posts'>
            @foreach ($posts as $post)
                <div class='post'>
                    <h2 class='title'>
                        <a href="/posts/{{ $post->id }}">Post {{ $post->created_at }}</a>
                    </h2>
                    <p class='event'>{{ $post->event}}</p>
                    <p class='impression'>{{ $post->impression}}</p>
                    <p class='reaction'>{{ $post->reaction}}</p>
                    <a href="/tags/{{ $post->tag->id }}">{{ $post->tag->name }}</a>
                    <a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
                    <p class='feedback'>→{{ $post->feedback}}</p>
              </div>
              <div class="feedback"><button onclick="location.href='/posts/{{ $post->id }}/feedback'">フィードバック</button></div>
            @endforeach
        </div>
         <div class='paginate'>
            {{ $posts->links() }}
         </div>
@endsection