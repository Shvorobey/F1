<?php

namespace App\Http\Controllers;

use App\Race;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RacesController extends Controller
{
    public function all()
    {
        if (Auth::check() && Auth::user()->role >= 1) {

            return view('Admin.Race.races', ['races' => Race::all()]);
        }
        return abort(404);
    }

    public function add(Request $request)
    {
        if (Auth::check() && Auth::user()->role >= 1 && $request->method() == 'POST') {
            // Post validation
            $this->validate($request, [
                    'name' => 'required | max:50 | min: 3',
                    'start' => 'required | date',
                ]
            );
            $race = new Race();
            $race->name = $request->input('name');
            $race->start = $request->input('start');
            $race->save();

            \Session::flash('flash', 'Гонка ' . $race->name . ' успешно добавлена.');

            return back();
        }
        return abort(404);
    }

    public function delete(Request $request)
    {
        if (Auth::check() && Auth::user()->role >= 1 && $request->method() == 'DELETE') {
            $race = Race::find($request->input('id'));
            $race->delete();
            \Session::flash('flash', 'Гонка ' . $race->name . ' успешно удалена.');

            return back();
        }
        return abort(404);
    }

    public function edit($id)
    {
        if (Auth::check() && Auth::user()->role >= 1) {

            return view('Admin.Race.race_edit', [
                    'race' => Race::where('id', '=', $id)->first()
                ]
            );
        }
        return abort(404);
    }

    public function update(Request $request)
    {
        if (Auth::check() && Auth::user()->role >= 1 && $request->method() == 'POST') {
            $this->validate($request, [
                    'name' => 'required | max:50 | min: 3',
                    'start' => 'required | date',
                ]
            );
            $race = Race::where('id', '=', $request->input('id'))->first();
            $race->name = $request->input('name');
            $race->start = $request->input('start');
            $race->save();
            \Session::flash('flash', 'Гонка ' . $race->name . ' успешно изменена.');

            return redirect('races');
        }
        return abort(404);
    }

    public function race_activate($id)
    {
        if (Auth::check() && Auth::user()->role >= 1) {
            Race::where('is_active', 1)->update(['is_active' => 0]);
            Race::where('id', $id)->update(['is_active' => 1]);

            return back();
        }
        return abort(404);
    }
}
