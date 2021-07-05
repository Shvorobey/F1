<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    public function rule(){
        return $this->belongsTo(Rule::class);
    }
}
