<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Competition;
use App\Post;
use App\Rule;
use App\SocialNetwork;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        return view('Pages.index');
    }

    public function posts()
    {
        return view('Pages.blog', [
            'posts' =>  Post::orderBy('id', 'DESC')->paginate(5),
            'best_posts' => Post::orderBy('views', 'DESC')->limit(3)->get(),
            'social_networks' => SocialNetwork::all()
        ]);
    }

    public function single_post($id)
    {
        $post = Post::where('id', '=', $id)->first();
        $post->views +=1;
        $post->save();

        return view('Pages.single_post', [
            'post' => $post,
            'best_posts' => Post::orderBy('views', 'DESC')->limit(3)->get(),
            'social_networks' => SocialNetwork::all()
            ]);
    }

    public function add_comment(Request $request){
//        if (Auth::check()){
            if ($request->method() == 'POST'){
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
//        }
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
        ]);
    }
}
