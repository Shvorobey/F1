
@extends('Layouts.layout')

@section('meta_keywords', 'F1, Odessa, formula 1, news, формула 1, Ф1, Одесса, новости')

@section('meta_description', 'Новости формулы 1, Formula 1 news')

@section('content')

    </div>
</div>
<!-- END HEADER -->

<!-- SLOGAN -->
<div class="slogan">
    <h2>Новостной блог</h2>
</div>
<!-- START PRIMARY -->
<div id="primary" class="sidebar-right">
    <div class="container group">
        <div class="row">
            <!-- START CONTENT -->
            <div id="content-blog" class="span9 content group">
                @foreach($posts as $post)
                <div class="post type-post status-publish format-standard category-design category-themes tag-cleam tag-corporate tag-minimal group blog-libra-small row">
                    <div class="date-comments span1">
                        <p class="date">
                            <span class="month">{{date('M', strtotime($post->created_at))}}</span>
                            <span class="day">{{date('d', strtotime($post->created_at))}}</span>
                        </p>

                        <p class="comments">
                            <span>
                                        <img src="/images/my/eye.png" width="20" height="10" alt="Просмотры">
                                        <br>
                                        {{$post->views}}
                                </span>
                        </p>
                    </div>

                    <!-- post featured & title -->

                    <div class="thumbnail span4">
                        <img width="370" height="320" src="/images/blog/{{$post->image}}" class="attachment-blog_libra_small wp-post-image" alt="23"/>

                    </div>

                    <!-- post title -->
                    <div class="span4">

                        <h2 class="post-title">
                            <a href="blog-detail.hmtl">
                                {{$post->title}}
                            </a>
                        </h2>

                        <div class="the-content">
                            <p>
                                {{mb_substr($post->body, 0, 350)}} ...
                            </p>
                            <p>
                                <a href="{{route('single_post', $post->id)}}" class="not-btn more-link">
                                    Читать далее
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
                    <div class='general-pagination group'>
                        @if($posts->currentPage() !=1)
                            <a href='?page=1'>1</a>
                            <a href='{{$posts->previousPageUrl()}}'><=</a>
                        @endif
                        @if($posts->count()>1)
                            @for($count=1; $count<=$posts->lastPage(); $count++)
                                @if($count > $posts->currentPage()-3 and $count < $posts->currentPage()+3)
                                        <a href='?page={{$count}}' @if($count==$posts->currentPage()) class='selected' @endif>{{$count}}</a>
                                @endif
                            @endfor
                        @endif
                        @if($posts->currentPage() != $posts->lastPage())
                                <a href='{{$posts->nextPageUrl()}}' >=></a>
                                <a href='?page={{$posts->lastPage()}}'>{{$posts->lastPage()}}</a>
                        @endif
                </div>
            </div>
            <!-- END CONTENT -->


            <!-- START SIDEBAR -->
            <div id="sidebar-blog-sidebar" class="span3 sidebar group">
                <div class="widget-first widget recent-posts">
                    <h3>Топ <span class="title-highlight">новости</span></h3>
                    @foreach($best_posts as $best_post)
                    <div class="recent-post group">
                        <div class="hentry-post group">
                            <div class="thumb-img">
                                <img width="100" height="75" src="/images/blog/{{$best_post->image}}" class="attachment-blog_thumb wp-post-image" alt="23" />
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
