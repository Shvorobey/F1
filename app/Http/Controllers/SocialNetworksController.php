<?php

namespace App\Http\Controllers;

use App\SocialNetwork;
use Illuminate\Http\Request;

class SocialNetworksController extends Controller
{
    public function social_networks(){
        return view('Admin.social_networks', ['social_networks' => SocialNetwork::all()]);
    }

    public function add_pilot(Request $request){
//        if (Auth::check()) {
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
//        } else {
//            return redirect()->route('index');
//        }
    }

    public function delete(Request $request){
//        if (Auth::check()) {
        if ($request->method() == 'DELETE') {
            $pilot = Pilot::find($request->input('id'));
            $pilot->delete();
            \Session::flash('flash', 'Пилот ' . $pilot->name . ' больше никуда не едет.');

            return back();
        }
//        } else {
//            return redirect()->route('404');
//        }
    }

    public function edit_pilot(Request $request){
//        if (Auth::check()) {
        if ($request->method() == 'POST') {
            $this->validate($request, [
                    'name' => 'required | max:50 | min: 3',
                ]
            );
            $pilot = Pilot::where('id', '=', $request->input('id'))->first();
            $pilot->name = $request->input('name');
            $pilot->save();

            \Session::flash('flash', 'Имя пилота # ' . $pilot->id . ' успешно изменено на '. $pilot->name . '.');

            return back();
        }
//        } else {
//            return redirect()->route('404');
//        }
    }
}
