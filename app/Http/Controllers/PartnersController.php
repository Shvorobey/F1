<?php

namespace App\Http\Controllers;

use App\Competition;
use App\Partner;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartnersController extends Controller
{
    public function partners(Request $request)
    {
        if ($request->method() == 'DELETE') {
            $partner = Partner::find($request->input('id'));
            $partner->delete();
            \Session::flash('flash', 'Партнер ' . $partner->name . ' успешно удален.');

            return back();
        }

        return view('Admin.Partners.partners', ['partners' => Partner::all()]);
    }

    public function add(Request $request)
    {
        if ($request->method() == 'POST') {
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
        return view('Admin.Partners.partner_add');

    }

    public function edit($id, Request $request)
    {
        if ($request->method() == 'POST') {
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

        return view('Admin.Partners.partner_edit', ['partner' => Partner::find($id)]);

    }
}
