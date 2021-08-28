<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Composer\Autoload\includeFile;

class UsersController extends Controller
{
    public function users(Request $request)
    {
        if ($request->method() == 'POST') {
            $id = $request->input('id');
            $role = $request->input('role');

            if ($role == 1) {
                User::where('id', $id)->update(['role' => 0]);
                \Session::flash('flash', 'Пользователь № ' . $id . ' убран из администраторов.');

                return back();

            } elseif ($role == 0) {
                User::where('id', $id)->update(['role' => 1]);
                \Session::flash('flash', 'Пользователь № ' . $id . ' добавлен в администраторы.');

                return back();
            }
        }

        if ($request->method() == 'DELETE') {
            $user = User::findOrFail($request->input('id'));
            if ($user->role != 2) {
                $user->delete();
                \Session::flash('flash', 'Пользователь ' . $user->name . ' успешно удален.');

                return back();
            }
        }

        return view('Admin.Users.users', ['users' => User::all()]);

    }
}
