@extends('layouts.app')　　　　　　　　　　　　　　　　　　

@section('content')
        <h1>Introspect</h1>
        <form action="/posts" method="POST">
            @csrf
            <h2 class='title'>Post{{ old('post.id') }}</h2>
            <div class="event">
                <h3>event</h3>
                <textarea name="post[event]" placeholder="何があった？">{{ old('post.event') }}</textarea>
            </div>
            <div class="impression">
                <h3>impression</h3>
                <textarea name="post[impression]" placeholder="どう思った？">{{ old('post.impression') }}</textarea>
            </div>
            <div class="reaction">
                <h3>reaction</h3>
                <textarea name="post[reaction]" placeholder="どう反応した？">{{ old('post.reaction') }}</textarea>
            </div>
            <div class="tag">
                <h3>tag</h3>
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
                <h3>Category</h3>
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
        <div class="back">[<a href="/">ホームに戻る</a>]</div>
@endsection