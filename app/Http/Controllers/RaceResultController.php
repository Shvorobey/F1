<?php

namespace App\Http\Controllers;

use App\Pilot;
use App\Race;
use App\RaceResult;
use Illuminate\Http\Request;

class RaceResultController extends Controller
{
    public function race_result(Request $request)
    {
        if ($request->method() == 'POST') {
            $race_id = $request->input('race_id');
            foreach ($request->post() ['place_'] as $pilot_id => $place) {
                $race_result = new RaceResult();
                $race_result->race_id = (int)$race_id;
                $race_result->pilot_id = (int)$pilot_id;
                $race_result->place = (int)$place;
                $race_result->pole_position = $pilot_id == $request->input('pole_position') ? 1 : 0;
                $race_result->fastest_lap = $pilot_id == $request->input('fastest_lap') ? 1 : 0;
                $race_result->save();
            }
            \Session::flash('flash', 'Результаты гонки сохранены');

            return redirect()->route('races');
        }

        return view('Admin.RaceResult.race_result', [
                'pilots' => Pilot::all(),
                'race' => Race::where('is_active', 1)->firstOrFail()
            ]
        );
    }

    public function single(Request $request, $id)
    {
        if ($request->method() == 'POST') {
            foreach ($request->post() ['result_'] as $result_id => $place) {
                $race_result = RaceResult::findOrFail($result_id);
                $race_result->place = (int)$place;
                $race_result->pole_position = $race_result->pilot_id == $request->input('pole_position') ? 1 : 0;
                $race_result->fastest_lap = $race_result->pilot_id == $request->input('fastest_lap') ? 1 : 0;
                $race_result->save();
            }
            \Session::flash('flash', 'Результаты гонки обновлены');

            return redirect()->route('race_result_single', $id);
        }
        return view('Admin.RaceResult.race_result_edit', [
                'results' => RaceResult::where('race_id', '=', $id)->get(),
                'race' => Race::findOrFail($id),
            ]
        );
    }
}
