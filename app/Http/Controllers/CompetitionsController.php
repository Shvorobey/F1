<?php

namespace App\Http\Controllers;

use App\Competition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompetitionsController extends Controller
{
    public function competitions()
    {
        if (Auth::check() && Auth::user()->role >= 1) {

            return view('Admin.Competitions.competitions', ['competitions' => Competition::all()]);
        }
        return abort(404);
    }

    public function edit($id)
    {
        if (Auth::check() && Auth::user()->role >= 1) {
            return view('Admin.Competitions.competition_edit', ['competition' => Competition::find($id)]);
        }
        return abort(404);
    }

    public function update(Request $request)
    {
        if (Auth::check() && Auth::user()->role >= 1 && $request->method() == 'POST') {
            // Post validation
            $this->validate($request, [
                    'name' => 'string | required | min: 2 | max:255',
                    'description' => 'required | min: 5 | max: 2000',
                ]
            );
            $competition = Competition::find($request->input('id'));
            $competition->name = $request->input('name');
            $competition->description = $request->input('description');

            $competition->save();

            \Session::flash('flash', 'Конкурс ' . $competition->name . ' успешно обновлен.');

            return redirect()->route('competitions');
        }
        return abort(404);
    }

    public function delete(Request $request)
    {
        if (Auth::check() && Auth::user()->role >= 1 && $request->method() == 'DELETE') {
            $competition = Competition::find($request->input('id'));
            $competition->delete();
            \Session::flash('flash', 'Конкурс ' . $competition->name . ' успешно удален.');

            return back();
        }
        return abort(404);
    }
}
