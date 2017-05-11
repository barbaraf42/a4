<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    public function addresses() {
        return $this->belongsToMany('App\Address')->withTimestamps();
    }

}
