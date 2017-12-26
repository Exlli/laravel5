<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Page;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::paginate(7);
        return view('home',['pages'=>$pages]);
    }
}
