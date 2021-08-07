<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RaceResult extends Model
{
    public function race(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Race');
    }

    public function pilot(){
        return $this->belongsTo('App\Pilot');
    }
}
