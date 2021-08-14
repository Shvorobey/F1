@extends('Layouts.layout')

@section('title', 'F1 | Odessa')

@section('content')

    <!-- BEGIN FLEXSLIDER SLIDER -->
    <div id="slider-polaroid-0" class="slider slider-polaroid polaroid no-responsive" style="height:400px;">
        <div class="thumbs  container">
            @foreach($sliders as $slider)
                <div class="thumb">
                    <img src="/images/slider/flexslider/{{$slider->small_image}}"
                         alt="/images/slider/flexslider/{{$slider->big_image}}"/>
                    <div class="slide-content container align-right full"
                         style="background-image:url('/images/slider/flexslider/{{$slider->big_image}}');">
                        <div class="text">
                            <h2>{!! $slider->title !!}</h2>
                            <p>
                                {!! $slider->text !!}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $('#slider-polaroid-0').polaroid({
                animation: '',
                pause: 8000,
                animationSpeed: 800
            });
        });
    </script>

    <div class="mobile-slider">
        <div class="slider fixed-image container">
            <img src="images/slider/flexslider/fixed-polaroid.jpg" alt=""/>
        </div>
    </div>
    </div>
    <!-- END HEADER -->

    <!-- START PRIMARY -->
    <div id="primary" class="sidebar-no">
        <div class="container group">
            <div class="row">
                <!-- START CONTENT -->
                <div id="content-home" class="span12 content group">
                    <div class="page type-page status-publish hentry group">
                        @inject('competitions', '\App\Competition')
                        @foreach($competitions->getCompetition() as $competition)
                            <a href="/competition/{{$competition->key}}" title="{{$competition->name}}">
                                <div class="box-sections numbers-sections margin-bottom ">
                                    <div class="number number-left number-zero"></div>
                                    <div class="number number-right number-{{$loop->index + 1}}"></div>
                                    <h4>
                                        {{$competition->name}}
                                    </h4>
                                    <p>
                                        {!! $competition->description !!}
                                    </p>
                                </div>
                            </a>
                        @endforeach
                        <div class="clear"></div>
                        <div class="row">
                            <!-- START SECTION BLOG -->
                            @foreach($_post as $post)
                                <div class="section blog margin-bottom span12">
                                    <h2 class="title">
                                        Топ <span class="title-highlight">новость</span>
                                    </h2>
                                    <div class="row">
                                        <div
                                            class="post type-post status-publish format-video category-design span12 sticky">
                                            <div class="row">
                                                <div class="thumbnail span6">
                                                    <img width="263" height="243" src="/images/blog/{{$post->image}}"
                                                         class="attachment-section_blog wp-post-image" alt="3"/>
                                                    <div class="date span1">
                                                        <p>
                                                            <span
                                                                class="month">{{date('M', strtotime($post->created_at))}}</span>
                                                            <span
                                                                class="day">{{date('d', strtotime($post->created_at))}}</span>
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="the-content span6">
                                                    <h4>
                                                        <a href="{{route('single_post', $post->id)}}"
                                                           title="{{$post->title}}">
                                                            {!! $post->title !!}
                                                        </a>
                                                    </h4>
                                                    <p>
                                                        {!! mb_substr($post->body, 0, 250) !!} ...
                                                    </p>
                                                    <p>
                                                        <a href="{{route('single_post', $post->id)}}" class="more-link">||
                                                            читать польностью</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <!-- END SECTION BLOG -->

                                <div class="clear"></div>
                        </div>
                        <div class="margin-bottom">
                            <div class="logos-slider wrapper">
                                <h2>
                                    Наши <span class="title-highlight">партнеры</span>
                                </h2>
                                <div class="list_carousel">
                                    <ul class="logos-slides">
                                        @foreach($partners as $partner)
                                            <li style="height: 70px;">
                                                <a href="{{$partner->link}}" class="bwWrapper" target="_blank">
                                                    <img src="images/slider/{{$partner->image}}"
                                                         style="max-height: 70px;"
                                                         class="logo"/>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="clear"></div>
                                <div class="nav">
                                    <a class="prev" href="#"></a>
                                    <a class="next" href="#"></a>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>

                        <script type="text/javascript">
                            jQuery(function ($) {

                                $('.logos-slides').imagesLoaded(function () {
                                    $('.logos-slides').carouFredSel({
                                        auto: true,
                                        width: '100%',
                                        prev: '.logos-slider .prev',
                                        next: '.logos-slider .next',
                                        swipe: {
                                            onTouch: true
                                        },
                                        scroll: {
                                            items: 1,
                                            duration: 500
                                        }
                                    });
                                });

                                $('.bwWrapper').BlackAndWhite({
                                    hoverEffect: true, // default true
                                    // set the path to BnWWorker.js for a superfast implementation
                                    webworkerPath: false,
                                    // for the images with a fluid width and height
                                    responsive: true,
                                    speed: { //this property could also be just speed: value for both fadeIn and fadeOut
                                        fadeIn: 200, // 200ms for fadeIn animations
                                        fadeOut: 300 // 800ms for fadeOut animations
                                    }
                                });

                                $("a.bwWrapper[href='#']").click(function () {
                                    return false
                                })

                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type='text/javascript' src='/sliders/polaroid/js/jquery.polaroid.js'></script>
    <script type='text/javascript' src='/sliders/polaroid/js/jquery.transform-0.8.0.min.js'></script>
    <script type='text/javascript' src='/sliders/polaroid/js/jquery.preloader.js'></script>
    <!-- END PRIMARY -->
@endsection
