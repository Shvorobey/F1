<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Competition;
use App\Partner;
use App\Post;
use App\Rule;
use App\SocialNetwork;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Wkhooy\ObsceneCensorRus;


class PagesController extends Controller
{
    public function index()
    {
        return view('Pages.index', [
                '_post' => Post::where('set', '=', 2)->limit(1)->get(),
                'partners' => Partner::all()
            ]
        );
    }

    public function posts()
    {
        return view('Pages.blog', [
                'posts' => Post::orderBy('id', 'DESC')->paginate(5),
                'best_posts' => Post::where('set', '>', 0)->orderBy('set', 'desc')->limit(5)->get(),
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
                'best_posts' => Post::where('set', '>', 0)->orderBy('set', 'desc')->limit(5)->get(),
                'social_networks' => SocialNetwork::all()
            ]
        );
    }

    public function add_comment(Request $request)
    {
        if (Auth::check() && $request->method() == 'POST') {
            $this->validate($request, [
                    'comment' => 'required | max:1000 | min: 2',
                ]
            );
            $comment = new Comment();
            $comment->post_id = $request->input('post_id');
            $comment->author = Auth::user()->name;
            $comment->text = ObsceneCensorRus::getFiltered($request->input('comment'));
            $comment->save();

            return back();
        }
        return abort(404);
    }

    public function delete_comment($id){
        if (Auth::check() && Auth::user()->role >= 1) {
            $comment = Comment::find($id);
            $comment->delete();
            \Session::flash('flash', 'Коментарий успешно удален.');
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
}
