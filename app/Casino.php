<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Casino extends Model
{
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\User');
    }
}
