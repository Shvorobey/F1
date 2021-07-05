<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    public function points(){
        return $this->hasMany(Point::class);
    }
}
