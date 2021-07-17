<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Composer\Autoload\includeFile;

class UsersController extends Controller
{
    public function all()
    {
        if (Auth::check() && Auth::user()->role >= 1) {

            return view('Admin.users', ['users' => User::all()]);
        }
        return abort(404);
    }

    public function admin_activate(Request $request){
        if (Auth::check() && Auth::user()->role >= 1 && $request->method() == 'POST') {
                $id = $request->input('id');
                $role = $request->input('role');

                if($role == 1){
                    User::where('id', $id)->update(['role' => 0]);
                    \Session::flash('flash', 'Пользователь № ' . $id . ' убран из администраторов.');

                    return back();
                }elseif($role == 0){
                    User::where('id', $id)->update(['role' => 1]);
                    \Session::flash('flash', 'Пользователь № ' . $id . ' добавлен в администраторы.');

                    return back();
                }
        }
        return abort(404);
    }

    public function delete(Request $request)
    {
        if (Auth::check() && Auth::user()->role >= 1 && $request->method() == 'DELETE') {
                $user = User::find($request->input('id'));
                if ($user->role != 2){
                    $user->delete();
                    \Session::flash('flash', 'Пользователь ' . $user->name . ' успешно удален.');
                    return back();
                }
            }
            return abort(404);
    }
}
