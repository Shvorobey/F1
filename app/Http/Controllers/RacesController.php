<?php

namespace App\Http\Controllers;

use App\Race;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RacesController extends Controller
{
    public function races(Request $request)
    {
        if ($request->method() == 'POST') {
            // Post validation
            $this->validate($request, [
                    'name' => 'required | max:50 | min: 3',
                    'start' => 'required | date',
                ]
            );
            $race = Race::create($request->all());

            \Session::flash('flash', 'Гонка ' . $race->name . ' успешно добавлена.');

            return back();
        }

        if ($request->method() == 'DELETE') {
            $race = Race::findOrFail($request->input('id'));
            if ($race->id == 1){
                \Session::flash('flash_error', 'Активная гонка не может быть удалена');

                return back();
            }
            $race->delete();
            \Session::flash('flash', 'Гонка ' . $race->name . ' успешно удалена.');

            return back();
        }

        return view('Admin.Race.races', ['races' => Race::all()]);
    }

    public function edit(Race $race, Request $request)
    {
        if ($request->method() == 'POST') {
            $this->validate($request, [
                    'name' => 'required | max:50 | min: 3',
                    'start' => 'required | date',
                ]
            );
            $race->name = $request->input('name');
            $race->start = $request->input('start');
            $race->save();
            \Session::flash('flash', 'Гонка ' . $race->name . ' успешно изменена.');

            return redirect('races');
        }
        return view('Admin.Race.race_edit', ['race' => $race,]);
    }

    public function race_activate($id)
    {
        Race::where('is_active', 1)->update(['is_active' => 0]);
        Race::where('id', $id)->update(['is_active' => 1]);

        return back();
    }
}
