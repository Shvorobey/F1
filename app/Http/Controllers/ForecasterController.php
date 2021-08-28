<?php

namespace App\Http\Controllers;

use App\Competition;
use App\Pilot;
use Illuminate\Http\Request;

class ForecasterController extends Controller
{
    public function index(){
        $pilots = Pilot::all();
        $name = Competition::where('key', '=', 'forecaster')->firstOrFail()->name;
        return view('Competitions.forecaster', [
            'pilots' => $pilots,
            'name' => $name
        ]);
    }
}
