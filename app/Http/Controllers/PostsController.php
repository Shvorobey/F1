<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function all(Request $request)
    {
        if ($request->method() == 'DELETE') {
            $post = Post::find($request->input('id'));
            $post->delete();
            \Session::flash('flash', 'Пост № ' . $post->id . ' успешно удален.');

            return back();
        }

        return view('Admin.Posts.posts', ['posts' => Post::orderBy('id', 'DESC')->paginate(10)]);
    }

    public function add(Request $request)
    {
        if ($request->method() == 'POST') {
            // Post validation
            $this->validate($request, [
                    'title' => 'string | required | min: 5 | max:255',
                    'body' => 'required | min: 100',
                    'image' => 'image',
                ]
            );
            $post = new Post();
            $post->title = $request->input('title');
            $post->body = $request->input('body');

            $image = $request->image;
            if ($image) {
                $imageName = rand(0, 10000) . time() . stristr($image->getClientOriginalName(), '.');
                $image->move('images/blog', $imageName);
                $post->image = $imageName;
            }
            $post->save();

            \Session::flash('flash', 'Пост № ' . $post->id . ' успешно добавлен.');

            return redirect()->route('single_post', $post->id);
        }

        return view('Admin.Posts.post_add');
    }

    public function edit(Request $request, $id)
    {
        if ($request->method() == 'POST') {
            // Post validation
            $this->validate($request, [
                    'title' => 'string | required | min: 5 | max:255',
                    'body' => 'required | min: 100 | max: 2500',
                    'image' => 'image',
                ]
            );
            $post = Post::find($request->input('id'));
            $post->title = $request->input('title');
            $post->body = $request->input('body');

            $image = $request->image;
            if ($image) {
                $imageName = rand(0, 10000) . time() . stristr($image->getClientOriginalName(), '.');
                $image->move('images/blog', $imageName);
                $post->image = $imageName;
            }
            $post->save();

            // Post adding logging
//                $log = new Logger('new');
//                $log->pushHandler(new StreamHandler(__DIR__ . '/../../Logs/new_posts_log.log', Logger::INFO));
//                $log->info('Пользователь ' . Auth::user()->name . ' добавил пост № ' . $post->id);
//                $log->info('Пост "' . $post->title . '" был добавлен пользователем с адресом: ' . Auth::user()->email);
//
//                $logger = new \Katzgrau\KLogger\Logger(__DIR__ . '/../../Logs');
//                $logger->info('Katzgrau:Пользователь ' . Auth::user()->name . ' добавил пост № ' . $post->id);

            \Session::flash('flash', 'Пост № ' . $post->id . ' успешно изменен.');

            return redirect()->route('single_post', $post->id);
        }

        return view('Admin.Posts.post_edit', ['post' => Post::find($id)]);

    }

    public function post_set($id, Request $request)
    {
        if ($request->method() == 'POST') {
            $id = $request->input('id');
            $set = $request->input('set');

            if ($set == 1) {
                Post::where('id', $id)->update(['set' => 0]);
                \Session::flash('flash', 'Пост № ' . $id . ' убран из закрепленных.');
            } else {
                Post::where('id', $id)->update(['set' => 1]);
                \Session::flash('flash', 'Пост № ' . $id . ' добавлен в закрепленные.');
            }
            return back();
        }

        Post::where('set', 2)->update(['set' => 0]);
        Post::where('id', $id)->update(['set' => 2]);

        return back();
    }
}
