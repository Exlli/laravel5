@extends('admin.app')

@section('content')
    <h4>
        <a href="/">返回首页</a>
    </h4>

    <h1 style="text-align: center; margin-top: 50px;">{{ $article->title }}</h1>
    <div id="content" style="padding: 50px;">
        <p>
            {{ $article->body }}
        </p>
    </div>
@endsection