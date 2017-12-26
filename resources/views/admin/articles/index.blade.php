@extends('admin.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">管理文章</div>

                    <div class="panel-body articles">

                        <a href="{{ route('web:articles.create') }}" class="btn btn-lg btn-primary">新增</a>

                        <table class="table table-striped">
                            <tr>
                                <th>编号</th>
                                <th>image</th>
                                <th>标题</th>
                                <th>操作</th>
                            </tr>
                            @foreach ($articles as $article)
                                <tr>
                                    <th>{{ $article->id }}</th>
                                    <th><img style="width:100px;" src="{{ $article->image }}"></th>
                                    <th><a href="{{ route('web:articles.show',$article->id) }}">{{ $article->title }}</a></th>
                                    <th>
                                        <a href="{{ route('web:articles.edit',$article->id) }}" class="btn btn-success">编辑</a>
                                        <form action="{{ URL('admin/articles/'.$article->id) }}" method="POST" style="display: inline;">
                                            <input name="_method" type="hidden" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="btn btn-danger">删除</button>
                                        </form>
                                    </th>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            {{-- 分页 --}}
            <div class="pull-right ">
                {{ $articles->render() }}
            </div>
        </div>
    </div>
@endsection