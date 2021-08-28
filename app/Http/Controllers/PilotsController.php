<?php

namespace App\Http\Controllers;

use App\Pilot;
use Illuminate\Http\Request;

class PilotsController extends Controller
{
    public function pilots(Request $request)
    {
        if ($request->method() == 'POST') {
            // Post validation
            $this->validate($request, [
                    'name' => 'required | max:50 | min: 3',
                ]
            );
            $pilot = new Pilot();
            $pilot->name = $request->input('name');
            $pilot->save();

            // Post adding logging
//                $log = new Logger('new');
//                $log->pushHandler(new StreamHandler(__DIR__ . '/../../Logs/new_posts_log.log', Logger::INFO));
//                $log->info('Пользователь ' . Auth::user()->name . ' добавил пост № ' . $post->id);
//                $log->info('Пост "' . $post->title . '" был добавлен пользователем с адресом: ' . Auth::user()->email);

            \Session::flash('flash', 'Пилот ' . $pilot->name . ' успешно добавлен.');

            return back();
        }

        if ($request->method() == 'DELETE') {
            $pilot = Pilot::findOrFail($request->input('id'));
            $pilot->delete();
            \Session::flash('flash', 'Пилот ' . $pilot->name . ' больше никуда не едет.');

            return back();
        }

        return view('Admin.Pilots.pilots', ['pilots' => Pilot::all()]);
    }

    public function edit(Request $request)
    {
        $this->validate($request, [
                'name' => 'required | max:50 | min: 3',
            ]
        );
        $pilot = Pilot::where('id', '=', $request->input('id'))->firstOrFail();
        $pilot->name = $request->input('name');
        $pilot->save();

        \Session::flash('flash', 'Имя пилота # ' . $pilot->id . ' успешно изменено на ' . $pilot->name . '.');

        return back();
    }
}
