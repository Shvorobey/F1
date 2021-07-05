<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialNetwork extends Model
{
    public function getSocialNetworks(){
        return SocialNetwork::all();
    }
}
