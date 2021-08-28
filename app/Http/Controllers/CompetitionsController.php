<?php

namespace App\Http\Controllers;

use App\Competition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompetitionsController extends Controller
{
    public function competitions(Request $request)
    {
        if ($request->method() == 'DELETE') {
            $competition = Competition::findOrFail($request->input('id'));
            $competition->delete();
            \Session::flash('flash', 'Конкурс ' . $competition->name . ' успешно удален.');

            return back();
        }

        return view('Admin.Competitions.competitions', ['competitions' => Competition::all()]);
    }

    public function edit($id, Request $request)
    {
        if ($request->method() == 'POST') {
            // Post validation
            $this->validate($request, [
                    'name' => 'string | required | min: 2 | max:255',
                    'description' => 'required | min: 5 | max: 2000',
                ]
            );
            $competition = Competition::findOrFail($request->input('id'));
            $competition->name = $request->input('name');
            $competition->description = $request->input('description');

            $competition->save();

            \Session::flash('flash', 'Конкурс ' . $competition->name . ' успешно обновлен.');

            return redirect()->route('competitions');
        }

        return view('Admin.Competitions.competition_edit', ['competition' => Competition::findOrFail($id)]);
    }
}
