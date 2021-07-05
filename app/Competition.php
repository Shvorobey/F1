<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    public function getCompetition(){
        return Competition::all();
    }
}
