<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WechatUser extends Model
{
    //
    public $timestamps = false;
    protected $casts = [
        'options' => 'array',
    ];
    public function Info()
    {
        return $this->hasOne('App\Info', 'id');
    }
}
