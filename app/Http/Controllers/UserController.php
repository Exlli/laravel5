<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    /**
     * Ϊָ���û���ʾ����
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return "user-".$id;
    }
}
