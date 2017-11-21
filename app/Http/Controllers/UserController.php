<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    /**
     * 为指定用户显示详情
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return "user-".$id;
    }
}
