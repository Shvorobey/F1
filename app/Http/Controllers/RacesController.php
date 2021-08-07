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

            return view('Admin.races', ['races' => Race::all()]);
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
//                $race->start = date('Y-m-d ', strtotime($request->input('start')));
            $race->start = $request->input('start');
            $race->save();

            // Post adding logging
//                $log = new Logger('new');
//                $log->pushHandler(new StreamHandler(__DIR__ . '/../../Logs/new_posts_log.log', Logger::INFO));
//                $log->info('Пользователь ' . Auth::user()->name . ' добавил пост № ' . $post->id);
//                $log->info('Пост "' . $post->title . '" был добавлен пользователем с адресом: ' . Auth::user()->email);

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

            return view('Admin.race_edit', [
                    'race' => Race::where('id', '=', $id)->first()
                ]
            );
        }
        return abort(404);
    }

    public function save_edit(Request $request)
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
