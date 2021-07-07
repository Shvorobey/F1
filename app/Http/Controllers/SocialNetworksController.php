<?php

namespace App\Http\Controllers;

use App\SocialNetwork;
use Illuminate\Http\Request;

class SocialNetworksController extends Controller
{
    public function social_networks(){
        return view('Admin.social_networks', ['social_networks' => SocialNetwork::all()]);
    }

    public function add(){
        return view('Admin.social_networks_add');
    }

    public function save_new(Request $request){
//        if (Auth::check()) {
        if ($request->method() == 'POST') {
            // Post validation
            $this->validate($request, [
                    'name' => 'required | max:50 | min: 3',
                    'link' => 'required | url',
                ]
            );
            $social_network = new SocialNetwork();
            $social_network->name = $request->input('name');
            $social_network->link = $request->input('link');
            $social_network->save();

            // Post adding logging
//                $log = new Logger('new');
//                $log->pushHandler(new StreamHandler(__DIR__ . '/../../Logs/new_posts_log.log', Logger::INFO));
//                $log->info('Пользователь ' . Auth::user()->name . ' добавил пост № ' . $post->id);
//                $log->info('Пост "' . $post->title . '" был добавлен пользователем с адресом: ' . Auth::user()->email);

            \Session::flash('flash', 'Социальная сеть ' . $social_network->name . ' успешно добавлена.');
            return redirect()->route('social_networks');
        }
//        } else {
//            return redirect()->route('index');
//        }
    }

    public function edit($id){
        $social_network = SocialNetwork::where('id', '=', $id)->first();
        return view('Admin.social_network_edit', ['social_network' => $social_network]);
    }

    public function save_edit(Request $request){
//        if (Auth::check()) {
        if ($request->method() == 'POST') {
            $this->validate($request, [
                    'name' => 'required | max:50 | min: 3',
                    'link' => 'required | url',
                ]
            );
            $social_network = SocialNetwork::where('id', '=', $request->input('id'))->first();
            $social_network->name = $request->input('name');
            $social_network->link = $request->input('link');
            $social_network->save();

            \Session::flash('flash', 'Социальная сеть ' . $social_network->name . ' успешно изменена.');

            return redirect()->route('social_networks');
        }
//        } else {
//            return redirect()->route('404');
//        }
    }

    public function delete(Request $request){
//        if (Auth::check()) {
        if ($request->method() == 'DELETE') {
            $social_network = SocialNetwork::find($request->input('id'));
            $social_network->delete();
            \Session::flash('flash', 'Социальная сеть ' . $social_network->name . ' удалена.');

            return back();
        }
//        } else {
//            return redirect()->route('404');
//        }
    }


}
