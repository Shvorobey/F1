<?php

namespace App\Http\Controllers;

use App\SocialNetwork;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SocialNetworksController extends Controller
{
    public function social_networks()
    {
        if (Auth::check() && Auth::user()->role >= 1) {

            return view('Admin.SocialNetwork.social_networks', ['social_networks' => SocialNetwork::all()]);
        }
        return abort(404);
    }

    public function add(Request $request)
    {
        if (Auth::check() && Auth::user()->role >= 1 && $request->method() == 'POST') {
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

            \Session::flash('flash', 'Социальная сеть ' . $social_network->name . ' успешно добавлена.');

            return back();
        }
        return abort(404);
    }

    public function edit($id)
    {
        if (Auth::check() && Auth::user()->role >= 1) {

            return view('Admin.SocialNetwork.social_network_edit', [
                    'social_network' =>
                        SocialNetwork::where('id', '=', $id)->first()
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
        return abort(404);
    }

    public function delete(Request $request)
    {
        if (Auth::check() && Auth::user()->role >= 1 && $request->method() == 'DELETE') {
            $social_network = SocialNetwork::find($request->input('id'));
            $social_network->delete();
            \Session::flash('flash', 'Социальная сеть ' . $social_network->name . ' удалена.');

            return back();
        }
        return abort(404);
    }
}
