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

        if (Auth::check()) {
            $pil = Pilot::all()->toArray();
            $pilots_used = DB::table('casino_bets')
                ->where('user_id', Auth::user()->id)
                ->pluck('pilot_id')
                ->toArray();

            foreach ($pil as $pilot)
                if (!in_array($pilot['id'], $pilots_used))
                    $pilots[] = $pilot;

            if (!empty($bet = Competition::getCasinoBet($race->id)))
                $bet_pilot = Pilot::where('id', $bet->pilot_id)->first();
        }
        return view('Competitions.casino', [
            'pilots' => $pilots,
            'competition' => Competition::where('key', '=', 'casino')->first(),
            'race' => $race,
            'bet_pilot' => $bet_pilot,
            'stop_date' => Carbon::parse($race->start)->subMinute(20),
            'stop' => Competition::isExpired($race->start, 20),
            'finish' => date('F d Y H:i:00', strtotime(Carbon::parse($race->start)->subMinute(20))) . ' GMT+0300'
        ]);
    }

    public function bet_save(Request $request)
    {
        if (Auth::check() && $request->method() == 'POST') {
            $race = Race::find($request->input('race'));
            if (Competition::isExpired($race->start, 20)) {
                \Session::flash('flash', 'Время возможности сделать ставку вышло');
                return back();
            }
            $this->validate($request, [
                    'pilot' => 'required | integer | min: 1',
                    'race' => 'required | integer | min: 1',
                ]
            );
            if (!empty(Competition::getCasinoBet($race->id))) {
                Competition::updateBet($request->input('pilot'), $request->input('race'));

                return back();
            }
            Competition::addBet($request->input('pilot'), $request->input('race'));

            return back();
        }

        return abort(404);
    }
}
