<?php

namespace App\Http\Controllers;

use App\Competition;
use App\Rule;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        return view('Pages.index');
    }

    public function rule($key){
//        if (!in_array($key, ['casino', 'champions_league','forecaster']))
        $competition = Competition::where('key', '=', $key)->first();
        if (!$competition)
            return view('Errors.404');
        $rules = Rule::where('competition_key', '=', $key)->get();
        return view('Pages.rule', [
            'competition' => $competition,
            'rules' => $rules
        ]);
    }
}
