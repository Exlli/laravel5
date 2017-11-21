<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    // 建立一对多关系，关联comment表
    public function hasManyComments()
    {
        return $this->hasMany('App\Comment', 'page_id', 'id');
    }
}
