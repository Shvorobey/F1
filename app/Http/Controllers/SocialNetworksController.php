<?php

namespace App\Http\Controllers;

use App\SocialNetwork;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SocialNetworksController extends Controller
{
    public function social_networks(Request $request)
    {
        if ($request->method() == 'POST') {
            // Post validation
            $this->validate($request, [
                    'name' => 'required | max:50 | min: 3',
                    'link' => 'required | url',
                ]
            );
            $social_network = SocialNetwork::create($request->all());
            \Session::flash('flash', 'Социальная сеть ' . $social_network->name . ' успешно добавлена.');

            return back();
        }

        if ($request->method() == 'DELETE') {
            $social_network = SocialNetwork::findOrFail($request->input('id'));
            $social_network->delete();
            \Session::flash('flash', 'Социальная сеть ' . $social_network->name . ' удалена.');

            return back();
        }
        return view('Admin.SocialNetwork.social_networks', ['social_networks' => SocialNetwork::all()]);
    }

    public function edit(SocialNetwork $socialNetwork, Request $request)
    {
        if ($request->method() == 'POST') {
            $this->validate($request, [
                    'name' => 'required | max:50 | min: 3',
                    'link' => 'required | url',
                ]
            );
            $socialNetwork->name = $request->input('name');
            $socialNetwork->link = $request->input('link');
            $socialNetwork->save();

            \Session::flash('flash', 'Социальная сеть ' . $socialNetwork->name . ' успешно изменена.');

            return redirect()->route('social_networks');
        }
        return view('Admin.SocialNetwork.social_network_edit', ['social_network' => $socialNetwork]);
    }
}
