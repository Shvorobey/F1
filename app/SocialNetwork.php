<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialNetwork extends Model
{
    protected $fillable = ['name', 'link'];

    public function getSocialNetworks(){
        return SocialNetwork::all();
    }
}
