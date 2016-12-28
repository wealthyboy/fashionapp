<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photos extends Model
{
    //
    public function labels()
    {
        return $this->hasMany('App\ImageLabel');
    }
}
