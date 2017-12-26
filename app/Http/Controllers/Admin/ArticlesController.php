<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;


use Redirect, Auth;

class ArticlesController extends Controller {

    /**
     * Show all resources.
     *
     * @return Response
     */
    public function index(){
        $articles =  Article::paginate(7);
        return view('admin.articles.index',['articles'=>$articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:articles|max:255',
            'body' => 'required',
        ]);

        $article = new Article;
        $article->title = Input::get('title');
        $article->body = Input::get('body');
        $article->user_id = 1;//Auth::user()->id;

        if ($article->save()) {
            return Redirect::to('admin/articles');
        } else {
            return Redirect::back()->withInput()->withErrors('保存失败！');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        return view('admin.articles.edit')->withArticle(Article::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'title' => 'required|unique:articles,title,'.$id.'|max:255',
            'body' => 'required',
        ]);

        $article = Article::find($id);
        $article->title = Input::get('title');
        $article->body = Input::get('body');
        $article->user_id = 1;//Auth::user()->id;

        if(Input::hasFile('myfile')){
            $file = $request->file('myfile');
            // 检验一下上传的文件是否有效.
            if($file->isValid()){
                // 原文件名
                $clientName = $file -> getClientOriginalName();
                // 临时绝对地址
                $realPath = $file -> getRealPath();
                $destinationPath = 'uploads/';
                // 扩展名，上传文件的后缀.
                $entension = $file -> getClientOriginalExtension();
                $allow_entension = ['jpg','png','gif'];
                if($entension && !in_array($entension,$allow_entension)){
                    return Redirect::back()->withInput()
                        ->withErrors('You may only upload png, jpg or gif.！');
                }
                // mimeType
                $mimeTye = $file -> getClientMimeType();
                $filename = $clientName;

                // 移到指定目录
                $file->move($destinationPath, $filename);
                // 生成url
                $filePath = asset($destinationPath.$filename);

                //Db::table('articles')->insert(['image'=>$filePath]);
                DB::table('articles')
                    ->where('id',$id)
                    ->update(['image'=>$filePath]);
                //}
            }
        }

        if ($article->save()) {
            return Redirect::to('admin/articles');
        } else {
            return Redirect::back()->withInput()->withErrors('保存失败！');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();

        return Redirect::to('admin');
    }

    /**
     * show the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return view('admin.articles.show')->withArticle(Article::find($id));
    }

    /**
     * upload.
     * @return Response
     */
    public function upload(Request $request){
        // 接收文件信息 进行上传  
        $file = $request->file('myfile');
        // 检验一下上传的文件是否有效.  
        if($file->isValid()){  
            // 原文件名
            $clientName = $file -> getClientOriginalName();
            // 临时绝对地址
            $realPath = $file -> getRealPath();   
            // 扩展名，上传文件的后缀.
            $entension = $file -> getClientOriginalExtension();   
            // mimeType
            $mimeTye = $file -> getClientMimeType();
            $filename = date('Y-m-d-h-i-s').'-'.uniqid().'.'.$entension;
            $bool = Storage::disk('upload')->put($filename,file_get_contents($realPath));

            dd($bool);

            /*if(Db::table('articles')->insert(['image'=>$path])){
                return Redirect::to('admin');  
            }*/
        }
    }

}
