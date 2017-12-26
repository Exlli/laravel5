@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">编辑</div>

                    <div class="panel-body">

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('web:articles.update',$article->id) }}" method="POST" enctype="multipart/form-data">
                            <input name="_method" type="hidden" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="text" name="title" class="form-control" required="required" value="{{ $article->title }}">
                            <br>
                            <div class="uploadfile">
                                <input type="file" id="myfile" name="myfile" />
                            </div>
                            <br>
                            <textarea name="body" id="body-text" style="display: none;" class="form-control" required="required">
                                {{ $article->body }}
                            </textarea>
                            <div id="editor">
                                <p>{!! $article->body !!}</p>
                            </div>

                            <br>
                            <button class="btn btn-lg btn-info">编辑 Page</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection