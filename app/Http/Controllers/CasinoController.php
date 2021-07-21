<?php

namespace App\Http\Controllers;

use App\Competition;
use App\Pilot;
use App\Race;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CasinoController extends Controller
{
    public function index()
    {
        $pilots = [];
        $bet_pilot = '';
        $race = Race::where('is_active', 1)->first();
        $stop = true;
        $current = Carbon::now();
        $stop_date = Carbon::parse($race->start)->subMinute(20);
        if ($current->diffInSeconds($stop_date, false) <= 0) {
            $stop = false;
        }

        if (Auth::check()) {
            $pil = Pilot::all()->toArray();
            $pilots_used = DB::table('casino_bets')
                ->where('user_id', Auth::user()->id)
                ->pluck('pilot_id')
                ->toArray();

            foreach ($pil as $pilot)
                if (!in_array($pilot['id'], $pilots_used))
                    $pilots[] = $pilot;

            $bet = DB::table('casino_bets')
                ->where('user_id', Auth::user()->id)
                ->where('race_id', $race->id)
                ->first();

            if (!empty($bet))
                $bet_pilot = Pilot::where('id', $bet->pilot_id)->first();
        }
        return view('Competitions.casino', [
            'pilots' => $pilots,
            'competition' => Competition::where('key', '=', 'casino')->first(),
            'race' => $race,
            'bet_pilot' => $bet_pilot,
            'stop_date' => $stop_date,
            'stop' => $stop,
            'a' => date('F d Y H:i:00', strtotime($stop_date)) .  ' GMT+0300'
        ]);
    }

    public function bet_save(Request $request)
    {
        if (Auth::check() && $request->method() == 'POST') {
            $this->validate($request, [
                    'pilot' => 'required | integer | min: 1',
                    'race' => 'required | integer | min: 1',
                ]
            );
            DB::insert('insert into casino_bets (user_id, pilot_id, race_id) values (?, ?, ?)', [
                Auth::user()->id,
                $request->input('pilot'),
                $request->input('race')
            ]);
            \Session::flash('flash', 'Ставка принята');

            return back();
        }


        return abort(404);
    }
}
