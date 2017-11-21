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
        return view('admin/AdminHome')->withPages(Page::all());
    }
}
