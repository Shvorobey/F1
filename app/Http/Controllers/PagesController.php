<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Competition;
use App\Post;

use App\Rule;
use App\SocialNetwork;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
//use Illuminate\Validation\Rule;

class PagesController extends Controller
{
    public function index()
    {
        return view('Pages.index', [
                '_post' => Post::orderBy('created_at', 'DESC')->limit(1)->get()
            ]
        );
    }

    public function posts()
    {
        return view('Pages.blog', [
                'posts' => Post::orderBy('id', 'DESC')->paginate(5),
                'best_posts' => Post::orderBy('views', 'DESC')->limit(3)->get(),
                'social_networks' => SocialNetwork::all()
            ]
        );
    }

    public function single_post($id)
    {
        $post = Post::where('id', '=', $id)->first();
        $post->views += 1;
        $post->save();

        return view('Pages.single_post', [
                'post' => $post,
                'best_posts' => Post::orderBy('views', 'DESC')->limit(3)->get(),
                'social_networks' => SocialNetwork::all()
            ]
        );
    }

    public function add_comment(Request $request)
    {
        if (Auth::check() && $request->method() == 'POST') {
            $this->validate($request, [
                    'author' => 'required | max:50 | min: 3',
                    'comment' => 'required | max:1000 | min: 2',
                ]
            );
            $comment = new Comment();
            $comment->post_id = $request->input('post_id');
            $comment->author = $request->input('author');
            $comment->text = $request->input('comment');
            $comment->save();

            return back();
        }
        return abort(404);
    }

    public function rule($key)
    {
//        if (!in_array($key, ['casino', 'champions_league','forecaster']))
        $competition = Competition::where('key', '=', $key)->first();
        if (!$competition)
            return view('Errors.404');
        $rules = Rule::where('competition_key', '=', $key)->get();
        return view('Pages.rule', [
                'competition' => $competition,
                'rules' => $rules
            ]
        );
    }

    public function user_cabinet()
    {

        if (Auth::check()) {

            return view('Pages.user_cabinet', [
                    'user' => Auth::user()
                ]
            );
        }
        return abort(404);
    }

    public function user_edit()
    {
        if (Auth::check()) {

            return view('Pages.user_edit', [
                    'user' => Auth::user()
                ]
            );
        }
        return abort(404);
    }

    public function user_save_edit(Request $request)
    {
        if (Auth::check() && $request->method() == 'POST') {
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
        return abort(404);
    }
}
