<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Competition extends Model
{
    public function getCompetition()
    {
        return Competition::all();
    }

    public static function isExpired($race_start, $minutes): bool
    {
        $stop = false;
        $current = Carbon::now();
        $stop_date = Carbon::parse($race_start)->subMinute($minutes);
        if ($current->diffInSeconds($stop_date, false) <= 0) {
            $stop = true;
        }
        return $stop;
    }

    public static function getCasinoBet($race_id)
    {

        return DB::table('casino_bets')
            ->where('user_id', Auth::user()->id)
            ->where('race_id', $race_id)
            ->first();
    }

    public static function addBet($pilot, $race)
    {
        DB::insert('insert into casino_bets (user_id, pilot_id, race_id) values (?, ?, ?)', [
            Auth::user()->id,
            $pilot,
            $race
        ]);
        \Session::flash('flash', 'Ставка принята');
    }

    public static function updateBet($pilot, $race)
    {
        DB::table('casino_bets')
            ->where('user_id', Auth::user()->id)
            ->where('race_id', $race)
            ->update(['pilot_id' => $pilot]);
        \Session::flash('flash', 'Ставка успешно изменена');
    }
}
