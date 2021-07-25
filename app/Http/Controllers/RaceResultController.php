<?php

namespace App\Http\Controllers;

use App\Pilot;
use App\Race;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RaceResultController extends Controller
{
    public function race_result()
    {
        if (Auth::check() && Auth::user()->role >= 1) {
            return view('Admin.race_result', [
                    'pilots' => Pilot::all(),
                    'race' => Race::where('is_active', 1)->first()
                ]
            );
        }
        return abort(404);
    }

    public function save(Request $request){
        if (Auth::check() && Auth::user()->role >= 1) {
            $race_id = $request->input('race_id');
            foreach ($request->post() ['place_'] as $pilot_id => $place){
                DB::insert('insert into race_results (race_id, pilot_id, place) values (?, ?, ?)', [
                    $race_id,
                    $pilot_id,
                    $place
                ]);
                \Session::flash('flash', 'Результаты гонки сохранены');
            }
            return back();
        }

        return abort(404);
    }
}
