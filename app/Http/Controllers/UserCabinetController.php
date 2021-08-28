<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserCabinetController extends Controller
{
    public function user_cabinet()
    {

        return view('Pages.user_cabinet', [
                'user' => Auth::user()
            ]
        );
    }

    public function user_edit(Request $request)
    {
        if ($request->method() == 'POST') {
            $name = Auth::user()->name;
            $valid = Validator::make($request->input(), [
                    'name' => ['required', 'string', 'min:2', 'max:255', Rule::unique('users')->ignore(Auth::user()->id)],
                    'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::user()->id)],
                    'image' => ['image'],
                ]
            );
            if ($valid->fails())
                return back()->withErrors($valid->getMessageBag());

            $user = Auth::user();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $image = $request->avatar;
            if ($image) {
                $imageName = rand(0, 10000) . time() . stristr($image->getClientOriginalName(), '.');
                $image->move('images/avatars', $imageName);
                $user->avatar = $imageName;
            }
            if (
                !empty($request->input('current_password'))
                && Hash::check($request->input('current_password'), $user->password)
            ) {
                $this->validate($request, [
                    'current-password' => 'string',
                    'new_password' => 'required | min:8 | confirmed',
                    'new_password_confirmation' => 'required | same:new_password',
                ]);
                $user->password = Hash::make($request->input('new_password'));
            }
            \Session::flash('flash', 'Данные пользователя ' . $name . ' успешно обновлены.');
            $user->save();

            return redirect()->route('user_cabinet');
        }

        return view('Pages.user_edit', [
                'user' => Auth::user()
            ]
        );
    }
}
