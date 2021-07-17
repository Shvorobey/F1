<?php

namespace App\Http\Controllers;

use App\Partner;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartnersController extends Controller
{
    public function partners()
    {
        if (Auth::check() && Auth::user()->role >= 1) {

            return view('Admin.partners', ['partners' => Partner::all()]);
        }
        return abort(404);
    }

    public function add()
    {
        if (Auth::check() && Auth::user()->role >= 1) {
            return view('Admin.partner_add');
        }
        return abort(404);
    }

    public function save_new(Request $request)
    {
        if (Auth::check() && Auth::user()->role >= 1 && $request->method() == 'POST') {
            // Post validation
            $this->validate($request, [
                    'name' => 'string | required | min: 2 | max:255',
                    'link' => 'required | url',
                    'image' => 'required | image',
                ]
            );
            $partner = new Partner();
            $partner->name = $request->input('name');
            $partner->link = $request->input('link');

            $image = $request->image;
            if ($image) {
                $imageName = rand(0, 10000) . time() . stristr($image->getClientOriginalName(), '.');
                $image->move('images/slider', $imageName);
                $partner->image = $imageName;
            }
            $partner->save();

            \Session::flash('flash', 'Партнер ' . $partner->name . ' успешно добавлен.');

            return redirect()->route('partners');
        }
        return abort(404);
    }

    public function edit($id)
    {
        if (Auth::check() && Auth::user()->role >= 1) {
            return view('Admin.partner_edit', ['partner' => Partner::find($id)]);
        }
        return abort(404);
    }

    public function save_edit(Request $request)
    {
        if (Auth::check() && Auth::user()->role >= 1 && $request->method() == 'POST') {
            // Post validation
            $this->validate($request, [
                    'name' => 'string | required | min: 2 | max:255',
                    'link' => 'required | url',
                    'image' => 'image',
                ]
            );
            $partner = Partner::find($request->input('id'));
            $partner->name = $request->input('name');
            $partner->link = $request->input('link');

            $image = $request->image;
            if ($image) {
                $imageName = rand(0, 10000) . time() . stristr($image->getClientOriginalName(), '.');
                $image->move('images/slider', $imageName);
                $partner->image = $imageName;
            }
            $partner->save();

            \Session::flash('flash', 'Партнер ' . $partner->name . ' успешно обновлен.');

            return redirect()->route('partners');
        }
        return abort(404);
    }

    public function delete(Request $request)
    {
        if (Auth::check() && Auth::user()->role >= 1 && $request->method() == 'DELETE') {
            $partner = Partner::find($request->input('id'));
            $partner->delete();
            \Session::flash('flash', 'Партнер ' . $partner->name . ' успешно удален.');

            return back();
        }
        return abort(404);
    }
}
