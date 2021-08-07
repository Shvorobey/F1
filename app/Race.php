<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    public function raceResults(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\RaceResult');
    }
}
