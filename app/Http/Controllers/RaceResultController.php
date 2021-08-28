<?php

namespace App\Http\Controllers;

use App\Pilot;
use App\Race;
use App\RaceResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RaceResultController extends Controller
{
    public function race_result(Request $request)
    {
        if ($request->method() == 'POST') {
            $race_id = $request->input('race_id');
            foreach ($request->post() ['place_'] as $pilot_id => $place) {
                DB::insert('insert into race_results (race_id, pilot_id, place) values (?, ?, ?)', [
                    (int)$race_id,
                    (int)$pilot_id,
                    (int)$place
                ]);
                \Session::flash('flash', 'Результаты гонки сохранены');
            }

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
                DB::table('race_results')
                    ->where('id', (int)$result_id)
                    ->update(['place' => (int)$place]);
                \Session::flash('flash', 'Результаты гонки обновлены');
            }

            return redirect()->route('race_result_single', $id);
        }

        return view('Admin.RaceResult.race_result_edit', [
                'results' => RaceResult::where('race_id', '=', $id)->get(),
                'race' => Race::findOrFail($id),
            ]
        );
    }
}
