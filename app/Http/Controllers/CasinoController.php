<?php

namespace App\Http\Controllers;

use App\Casino;
use App\Competition;
use App\Pilot;
use App\Race;
use App\RaceResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CasinoController extends Controller
{
    const SCORE = [
        1 => 25,
        2 => 18,
        3 => 15,
        4 => 12,
        5 => 10,
        6 => 8,
        7 => 6,
        8 => 4,
        9 => 2,
        10 => 1,
    ];

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
        if ($request->method() == 'POST') {
            $race = Race::findOrFail($request->input('race'));
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

    public function count($id)
    {
        if (!empty(Casino::where('race_id', '=', $id)->first())) {
            \Session::flash('flash_error', 'Результаты прогнозов этой гонки уже посчитаны.');
            return back();
        }
        $bets = DB::table('casino_bets')
            ->where('race_id', $id)
            ->get()
            ->toArray();
        foreach ($bets as $bet) {
            $result = RaceResult::where('race_id', '=', $id)
                ->where('pilot_id', '=', $bet->pilot_id)
                ->first();
            if (!empty($result)) {
                $score = self::SCORE[$result->place] ?: 0;
                $bonus = !empty($result->pole_position) ? 5 : 0;
                $bonus += !empty($result->fastest_lap) ? 3 : 0;

                $total_score = 26 - $result->place + $score + $bonus;
                $casino = new Casino();
                $casino->user_id = $bet->user_id;
                $casino->race_id = $id;
                $casino->score = $total_score;
                $casino->save();
            }
        }
        \Session::flash('flash', 'Результаты прогнозов успешно посчитаны.');

        return redirect()->route('casino_results');
    }

    public function results()
    {
        $results = [];
        $final_results = [];
        foreach (Casino::orderBy('user_id', 'asc')->get() as $result) {
            $results[$result->user->name][$result->race_id] = $result->score;
        }
        foreach ($results as $user => $races) {
            $results[$user]['total'] = array_sum($races);
            $final_results[array_sum($races) . ' ' . $user] = $results[$user];
        }
        krsort($final_results, SORT_NUMERIC);

        return view('Competitions.casino_results', [
                'casino' => Competition::where('key', '=', 'casino')->first(),
                'races' => Race::all(),
                'results' => $final_results,
            ]
        );
    }
}
