
@extends('Layouts.layout')

@section('title', 'F1 | Odessa')

@section('content')
            </div>
        </div>
        <!-- END HEADER -->

        <!-- SLOGAN -->
        <div class="slogan">
            <h2>Вот такая вот новость</h2>
            <h3>are you curious, yeah?</h3>
        </div>
        <!-- START PRIMARY -->
        <div id="primary" class="sidebar-right">
            <div class="container group">
                <div class="row">
                    <!-- START CONTENT -->
                    <div id="content-blog" class="span9 content group">
                        <div class="post type-post status-publish format-standard hentry hentry-post group blog-libra-big row">
                            <!-- post featured & title -->
                            <div class="date-comments span1">
                                <p class="date">
                                    <span class="month">{{date('M', strtotime($post->created_at))}}</span>
                                    <span class="day">{{date('d', strtotime($post->created_at))}}</span>
                                </p>

                                <p class="comments">
                            <span>
                                        <img src="/images/my/eye.jpg" width="10" height="5" alt="Просмотры">
                                        <strong>{{$post->views}}</strong>
                                </span>
                                </p>
                            </div>
                            <div class="thumbnail span8">
                                <!-- post title -->

                                <img width="760" height="290" src="{{$post->image}}" class="attachment-blog_libra_big wp-post-image"/>
                                <!-- post meta -->
                                <h1 class="post-title">
                                    <strong>{{$post->title}}</strong>
                                </h1>
                            </div>
                            <div class="clear"></div>
                            <!-- post content -->
                            <div class="the-content single span8 group">
                                <p style="font-size: 125%">
                                    {{$post->body}}
                                </p>
                            </div>
                        </div>

                        <div id="comments">
                            <div id="respond">

{{--                        @if(Auth::check())--}}
{{--                            <hr>--}}
{{--                            @if(count($comments) == 0)<p>Коментариев пока нет.</p>@endif--}}
                                <h3 id="reply-title"><span>Коментарии:</span></h3>
                            @foreach($post->comments as $comment)
                                            <p class="comments">
                                Автор: <strong style="color: red">{{$comment->author}}</strong><br>
                                {{$comment->text}}<br>
                                Добавлен: {{date('d.m.Y в G:i', strtotime($comment->created_at))}}
                                <hr>
                                            </p>
                            @endforeach

{{--                            @if(Auth::user()->role == 2)--}}
                                <h3 id="reply-title">Добавить <span>коментарий</span></h3>
                                <form action="{{route('add_comment')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{$post->id}}">
                                    <input type="hidden" name="author" value="Vasya">
{{--                                    <input type="hidden" name="author" value="{{Auth::user()->name}}">--}}
                                    <textarea class="form-control" name="comment" ></textarea>
                                    <br>
                                    <button class="btn btn-outline-primary">Добавить комментарий</button>
                                </form>
{{--                            @endif--}}
{{--                        @else--}}
{{--                            <p>Войдите чтобы иметь возможность видеть комментарии и комментировать</p>--}}
{{--                    @endif--}}
                        <!-- START COMMENTS -->

                            </div>
                            <!-- #respond -->
                        </div>
                        <!-- END COMMENTS -->

                    </div>
                    <!-- END CONTENT -->

                    <!-- START SIDEBAR -->
                    <div id="sidebar-blog-sidebar" class="span3 sidebar group">
                        <div class="widget-first widget recent-posts">
                            <h3>Лидеры <span class="title-highlight">просмотров</span></h3>
                            @foreach($best_posts as $best_post)
                                <div class="recent-post group">
                                    <div class="hentry-post group">
                                        <div class="thumb-img">
                                            <img width="75" height="75" src="{{$best_post->image}}" class="attachment-blog_thumb wp-post-image" alt="23" />
                                        </div>
                                        <div class="text">
                                            <a href="blog-detail.hmtl" title="" class="title">
                                                {{$best_post->title}}
                                            </a>
                                            <p class="post-date">{{date('d F Y', strtotime($post->created_at))}}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @foreach($social_networks as $social_network)
                            <div >
                                <a href="{{$social_network->link}}" target="_blank">
                                    <img src="/images/my/{{$social_network->key}}.png" width="30" height="30" alt="{{$social_network->name}}">
                                    <strong>Присоеденяйся &rarr;</strong>
                                </a>
                            </div>
                        @endforeach

                    </div>
                    <!-- END SIDEBAR -->
                </div>
            </div>
        </div>
        <!-- END PRIMARY -->
@endsection
