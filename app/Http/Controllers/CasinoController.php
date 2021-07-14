<?php

namespace App\Http\Controllers;

use App\Competition;
use App\Pilot;
use App\Race;
use Illuminate\Http\Request;

class CasinoController extends Controller
{
    public function index(){
        $pilots = Pilot::all();
        $name = Competition::where('key', '=', 'casino')->first()->name;
        $race = Race::where('is_active', '=', 1)->first();
        return view('Competitions.casino', [
            'pilots' => $pilots,
            'name' => $name,
            'race' => $race
        ]);
    }
}
