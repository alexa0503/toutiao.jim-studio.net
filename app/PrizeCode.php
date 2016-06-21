<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrizeCode extends Model
{
    //
    public $timestamps = false;
    public function lottery()
    {
        return $this->hasOne('App\Lottery');
    }
    public function prize()
    {
        return $this->belongsTo('App\Prize', 'prize_id');
    }
}
