<?php

namespace App\Http\Controllers;

use App\Competition;
use App\Pilot;
use Illuminate\Http\Request;

class ChampionsLeagueController extends Controller
{
    public function index(){
        $pilots = Pilot::all();
        $name = Competition::where('key', '=', 'champions_league')->firstOrFail()->name;
        return view('Competitions.champions_league', [
            'pilots' => $pilots,
            'name' => $name
        ]);
    }
}
