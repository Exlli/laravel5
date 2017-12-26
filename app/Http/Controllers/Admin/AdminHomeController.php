<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Page;

class AdminHomeController extends Controller
{
    //
    public function index()
    {
        $pages = Page::paginate(7);
        return view('admin/AdminHome',['pages'=>$pages]);
    }
}
