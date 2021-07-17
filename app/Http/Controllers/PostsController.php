<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function all()
    {
        if (Auth::check() && Auth::user()->role >= 1) {
            return view('Admin.posts', ['posts' => Post::orderBy('id', 'DESC')->paginate(10)]);
        }
        return abort(404);
    }

    public function add()
    {
        if (Auth::check() && Auth::user()->role >= 1) {
            return view('Admin.post_add');
        }
        return abort(404);
    }

    public function save_new(Request $request)
    {
        if (Auth::check() && Auth::user()->role >= 1 && $request->method() == 'POST') {
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

            // Post adding logging
//                $log = new Logger('new');
//                $log->pushHandler(new StreamHandler(__DIR__ . '/../../Logs/new_posts_log.log', Logger::INFO));
//                $log->info('Пользователь ' . Auth::user()->name . ' добавил пост № ' . $post->id);
//                $log->info('Пост "' . $post->title . '" был добавлен пользователем с адресом: ' . Auth::user()->email);
//
//                $logger = new \Katzgrau\KLogger\Logger(__DIR__ . '/../../Logs');
//                $logger->info('Katzgrau:Пользователь ' . Auth::user()->name . ' добавил пост № ' . $post->id);

            \Session::flash('flash', 'Пост № ' . $post->id . ' успешно добавлен.');

            return redirect()->route('single_post', $post->id);
        }
        return abort(404);
    }

    public function edit($id)
    {
        if (Auth::check() && Auth::user()->role >= 1) {
            return view('Admin.post_edit', ['post' => Post::where('id', '=', $id)->first()]);
        }
        return abort(404);
    }

    public function save_edit(Request $request)
    {
        if (Auth::check() && Auth::user()->role >= 1 && $request->method() == 'POST') {
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
        return abort(404);
    }

    public function delete(Request $request)
    {
        if (Auth::check() && Auth::user()->role >= 1 && $request->method() == 'DELETE') {
                $post = Post::find($request->input('id'));
                $post->delete();
                \Session::flash('flash', 'Пост № ' . $post->id . ' успешно удален.');

                return back();
            }
        return abort(404);
    }

    public function post_set(Request $request)
    {
        if (Auth::check() && Auth::user()->role >= 1 && $request->method() == 'POST') {
            $id = $request->input('id');
            $set = $request->input('set');

            if ($set == 1){
                Post::where('id', $id)->update(['set' => 0]);
                \Session::flash('flash', 'Пост № ' . $id . ' убран из закрепленных.');
            }else{
                Post::where('id', $id)->update(['set' => 1]);
                \Session::flash('flash', 'Пост № ' . $id . ' добавлен в закрепленные.');
            }
            return back();
        }
        return abort(404);
    }

    public function post_best($id){
        if (Auth::check() && Auth::user()->role >= 1) {
            Post::where('set', 2)->update(['set' => 0]);
            Post::where('id', $id)->update(['set' => 2]);

            return back();
        }
        return abort(404);
    }
}
