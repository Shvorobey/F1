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
            $social_network = new SocialNetwork();
            $social_network->name = $request->input('name');
            $social_network->link = $request->input('link');
            $social_network->save();

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

    public function edit($id, Request $request)
    {
        if ($request->method() == 'POST') {
            $this->validate($request, [
                    'name' => 'required | max:50 | min: 3',
                    'link' => 'required | url',
                ]
            );
            $social_network = SocialNetwork::where('id', '=', $request->input('id'))->firstOrFail();
            $social_network->name = $request->input('name');
            $social_network->link = $request->input('link');
            $social_network->save();

            \Session::flash('flash', 'Социальная сеть ' . $social_network->name . ' успешно изменена.');

            return redirect()->route('social_networks');
        }
        return view('Admin.SocialNetwork.social_network_edit', [
                'social_network' =>
                    SocialNetwork::where('id', '=', $id)->firstOrFail()
            ]
        );
    }
}
