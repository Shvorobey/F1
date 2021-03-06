<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Competition;
use App\Partner;
use App\Post;
use App\Race;
use App\RaceResult;
use App\Rule;
use App\Slider;
use App\SocialNetwork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Wkhooy\ObsceneCensorRus;


class PagesController extends Controller
{
    public function index()
    {
        return view('Pages.index', [
                '_post' => Post::where('set', '=', 2)
                    ->limit(1)
                    ->get(),
                'partners' => Partner::all(),
                'sliders' => Slider::where('is_active', '=', 1)
                    ->orderBy('order', 'ASC')
                    ->limit(8)
                    ->get(),
            ]
        );
    }

    public function posts()
    {
        return view('Pages.blog', [
                'posts' => Post::orderBy('id', 'DESC')->paginate(5),
                'best_posts' => Post::where('set', '>', 0)->orderBy('set', 'desc')->limit(5)->get(),
                'social_networks' => SocialNetwork::all(),
            ]
        );
    }

    public function single_post($id)
    {
        $post = Post::where('id', '=', $id)->firstOrFail();
        $post->views += 1;
        $post->save();

        return view('Pages.single_post', [
                'post' => $post,
                'best_posts' => Post::where('set', '>', 0)->orderBy('set', 'desc')->limit(5)->get(),
                'social_networks' => SocialNetwork::all(),
            ]
        );
    }

    public function add_comment(Request $request)
    {
        if ($request->method() == 'POST' && empty($request->input('email'))) {

            $this->validate($request, [
                    'comment' => 'required | string | max:1000 | min: 2',
                ]
            );
            $comment = new Comment();
            $comment->post_id = $request->input('post_id');
            $comment->author = Auth::user()->name;
            $comment->text = ObsceneCensorRus::getFiltered($request->input('comment'));
            $comment->save();

            return back();
        }
        return abort(403);
    }

    public function delete_comment($id)
    {
        Comment::findOrFail($id)->delete();
        \Session::flash('flash', '???????????????????? ?????????????? ????????????.');

        return back();
    }

    public function rule($key)
    {
        return view('Pages.rule', [
                'competition' => Competition::where('key', '=', $key)->firstOrFail(),
                'rules' => Rule::where('competition_key', '=', $key)->get(),
            ]
        );
    }

    public function races()
    {
        return view('Pages.races', [
            'races' => Race::all(),
        ]);
    }

    public function single_race($id)
    {
        return view('Pages.single_race', [
                'results' => RaceResult::where('race_id', '=', $id)->orderBy('place', 'ASC')->get(),
                'race' => Race::findOrFail($id),
            ]
        );
    }
}
