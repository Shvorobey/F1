@extends('Layouts.layout')

@section('title', 'F1 | Odessa')

@section('content')

            <!-- BEGIN FLEXSLIDER SLIDER -->
            <div id="slider-polaroid-0" class="slider slider-polaroid polaroid no-responsive" style="height:400px;">
                <div class="thumbs  container">
                    <div class="thumb">
                        <img src="/images/slider/flexslider/002-150x150.png" alt="/images/slider/flexslider/002.png" />
                        <div class="slide-content container align-right" style="background-image:url('/images/slider/flexslider/002.png');">
                            <div class="text">
                                <h2>F1 Show the greatest racing spectacle on the planet.</h2>
                                <p>
                                    Показать величайшее гоночное зрелище на планете.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="thumb">
                        <img src="images/slider/flexslider/0026-150x150.jpg" alt="images/slider/flexslider/0026.jpg" />
                    </div>

                    <div class="thumb">
                        <img src="images/slider/flexslider/003-150x150.png" alt="images/slider/flexslider/003.png" />
                        <div class="slide-content container align-right" style="background-image:url('images/slider/flexslider/003.png');">
                            <div class="text">
                                <h2>Be nice. Be original.</h2>
                                <p>
                                    Quisque nec mi eu nibh aliquam elementum. Ut cursus nisl sit amet sapien dignissim at adipiscing lectus ornare. Aenean id lorem orci.
                                    Morbi lacinia nunc quis lectus condimentum rutrum.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="thumb">
                        <img src="images/slider/flexslider/0043-150x150.jpg" alt="images/slider/flexslider/0043.jpg" />
                        <div class="slide-content container align-right full" style="background-image:url('images/slider/flexslider/0043.jpg');">
                            <div class="container">
                                <div class="text">
                                    <h2>
                                        <span style="color: #0c243d;">Need a WordPress</span>
                                        <span style="color: #919303;">solution?</span>
                                    </h2>

                                    <p>
                                        <span style="color: #434f5b;">Check this theme.</span>
                                        <br />
                                        <span style="color: #8b8005;">Flexible, versatile, pixel perfect.</span>
                                    </p>

                                    <p>
                                    <span style="color: #434f5b;">
                                    A complete solution for your corporate/portfolio site.<br />
                                    </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="thumb">
                        <img src="images/slider/flexslider/0052-150x150.jpg" alt="images/slider/flexslider/0052.jpg" />
                        <div class="slide-content container align-right full" style="background-image:url('images/slider/flexslider/0052.jpg');">
                            <div class="container"></div>
                        </div>
                    </div>
                </div>
            </div>

            <script type="text/javascript">
                jQuery(document).ready(function($){
                    $('#slider-polaroid-0').polaroid({
                        animation: '',
                        pause: 8000,
                        animationSpeed: 800			    });
                });
            </script>

            <div class="mobile-slider">
                <div class="slider fixed-image container">
                    <img src="images/slider/flexslider/fixed-polaroid.jpg" alt="" />
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
                            <div class="box-sections numbers-sections margin-bottom ">
                                <div class="number number-left number-zero"></div>
                                <div class="number number-right number-{{$loop->index + 1}}"></div>
                                <h4>
                                    {{$competition->name}}
                                </h4>
                                <p>
                                    {{$competition->description}}
                                </p>
                            </div>
                            @endforeach
                            <div class="clear"></div>
                            <div class="row">
                                <!-- START SECTION BLOG -->
                                <div class="section blog margin-bottom span12">
                                    <h2 class="title">
                                        From the <span class="title-highlight">blog</span>
                                    </h2>
                                    <div class="row">
                                        <div class="post type-post status-publish format-video category-design span6 sticky">
                                            <div class="row">
                                                <div class="thumbnail span3">
                                                    <img width="263" height="243" src="images/3-263x243.jpg" class="attachment-section_blog wp-post-image" alt="3" />
                                                    <div class="date span1">
                                                        <p>
                                                            <span class="month">Oct</span>
                                                            <span class="day">17</span>
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="the-content span3">
                                                    <h4>
                                                        <a href="blog-detail.html" title="Section shortcodes &amp; sticky posts!">
                                                            Section shortcodes &amp; sticky posts!
                                                        </a>
                                                    </h4>

                                                    <p>
                                                        Fusce nec accumsan eros. Aenean ac orci a magna vestibulum posuere quis nec nisi.
                                                        Maecenas rutrum vehicula condimentum. Donec volutpat nisl ac mauris consectetur gravida.
                                                    </p>

                                                    <p>
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel vulputate nibh.
                                                        Pellentesque habitant <strong>morbi tristique</strong> senectus et netus et malesuada fames ac turpis egestas.
                                                    </p>

                                                    <p>
                                                        <a href="blog-detail.html" class="more-link">|| read the article</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="post type-post status-publish format-standard category-design category-themes tag-cleam tag-corporate tag-minimal span3">
                                            <div class="row">
                                                <div class="date span1">
                                                    <p>
                                                        <span class="month">Nov</span>
                                                        <span class="day">20</span>
                                                    </p>
                                                </div>

                                                <div class="meta span2">
                                                    <h4>
                                                        <a href="blog-detail.html" title="Nice &amp; Clean. The best for your blog!">
                                                            Nice &amp; Clean. The best for your blog!
                                                        </a>
                                                    </h4>
                                                    <p class="comments">
                                                        <a href="blog-detail.html#respond" title="Comment on Nice &amp; Clean. The best for your blog!">
                                                            <strong>Comments:</strong> 0
                                                        </a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="post type-post status-publish format-audio category-themes span3">
                                            <div class="row">
                                                <div class="date span1">
                                                    <p>
                                                        <span class="month">Oct</span>
                                                        <span class="day">29</span>
                                                    </p>
                                                </div>

                                                <div class="meta span2">
                                                    <h4>
                                                        <a href="blog-detail.html" title="Another theme by YIThemes!">
                                                            Another theme by YIThemes!
                                                        </a>
                                                    </h4>
                                                    <p class="comments">
                                                        <a href="##respond" title="Comment on Another theme by YIThemes!">
                                                            <strong>Comments:</strong> 0
                                                        </a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="post type-post status-publish format-quote category-uncategorized span3">
                                            <div class="row">
                                                <div class="date span1">
                                                    <p>
                                                        <span class="month">Jun</span>
                                                        <span class="day">18</span>
                                                    </p>
                                                </div>

                                                <div class="meta span2">
                                                    <h4>
                                                        <a href="blog-detail.html" title="Oscar Wilde">
                                                            Oscar Wilde
                                                        </a>
                                                    </h4>
                                                    <p class="comments">
                                                        <a href="#respond" title="Comment on Oscar Wilde">
                                                            <strong>Comments:</strong> 0
                                                        </a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="post type-post status-publish format-gallery category-design category-themes tag-css tag-html tag-php span3">
                                            <div class="row">
                                                <div class="date span1">
                                                    <p>
                                                        <span class="month">Apr</span>
                                                        <span class="day">09</span>
                                                    </p>
                                                </div>

                                                <div class="meta span2">
                                                    <h4>
                                                        <a href="blog-detail.html" title="This is the title of the first article. Enjoy it.">
                                                            This is the title of the first article. Enjoy it.
                                                        </a>
                                                    </h4>
                                                    <p class="comments">
                                                        <a href="##comments" title="Comment on This is the title of the first article. Enjoy it.">
                                                            <strong>Comments:</strong> 1
                                                        </a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END SECTION BLOG -->

                                <div class="clear"></div>
                            </div>

                            <div class="clear"></div>

                            <div class="margin-bottom">
                                <div class="logos-slider wrapper">
                                    <h2>
                                        Our <span class="title-highlight">partners</span>
                                    </h2>
                                    <div class="list_carousel">
                                        <ul class="logos-slides">

                                            <li style="height: 70px;">
                                                <a href="#" class="bwWrapper" >
                                                    <img src="images/slider/ugodno1.png" style="max-height: 70px;" class="logo" />
                                                </a>
                                            </li>

                                            <li style="height: 70px;">
                                                <a href="#" class="bwWrapper" >
                                                    <img src="images/slider/Tutti_1_01.png" style="max-height: 70px;" class="logo" />
                                                </a>
                                            </li>

                                            <li style="height: 70px;">
                                                <a href="#" class="bwWrapper" >
                                                    <img src="images/slider/tiecafe-011.png" style="max-height: 70px;" class="logo" />
                                                </a>
                                            </li>

                                            <li style="height: 70px;">
                                                <a href="#" class="bwWrapper" >
                                                    <img src="images/slider/Senza-titolo-1.png" style="max-height: 70px;" class="logo" />
                                                </a>
                                            </li>

                                            <li style="height: 70px;">
                                                <a href="#" class="bwWrapper" >
                                                    <img src="images/slider/nolt_400x4001.png" style="max-height: 70px;" class="logo" />
                                                </a>
                                            </li>

                                            <li style="height: 70px;">
                                                <a href="#" class="bwWrapper" >
                                                    <img src="images/slider/muffinstudio-011.png" style="max-height: 70px;" class="logo" />
                                                </a>
                                            </li>

                                            <li style="height: 70px;">
                                                <a href="#" class="bwWrapper" >
                                                    <img src="images/slider/logo-mix-1.png" style="max-height: 70px;" class="logo" />
                                                </a>
                                            </li>

                                            <li style="height: 70px;">
                                                <a href="#" class="bwWrapper" >
                                                    <img src="images/slider/ken.png" style="max-height: 70px;" class="logo" />
                                                </a>
                                            </li>

                                            <li style="height: 70px;">
                                                <a href="#" class="bwWrapper" >
                                                    <img src="images/slider/icecreammedia-011.png" style="max-height: 70px;" class="logo" />
                                                </a>
                                            </li>

                                            <li style="height: 70px;">
                                                <a href="#" class="bwWrapper" >
                                                    <img src="images/slider/garnise_011.png" style="max-height: 70px;" class="logo" />
                                                </a>
                                            </li>

                                            <li style="height: 70px;">
                                                <a href="#" class="bwWrapper" >
                                                    <img src="images/slider/capitan-cook1.png" style="max-height: 70px;" class="logo" />
                                                </a>
                                            </li>

                                            <li style="height: 70px;">
                                                <a href="#" class="bwWrapper" >
                                                    <img src="images/slider/bread1.png" style="max-height: 70px;" class="logo" />
                                                </a>
                                            </li>

                                            <li style="height: 70px;">
                                                <a href="#" class="bwWrapper" >
                                                    <img src="images/slider/Apuragreen2.png" style="max-height: 70px;" class="logo" />
                                                </a>
                                            </li>
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
                                jQuery(function($){

                                    $('.logos-slides').imagesLoaded(function(){
                                        $('.logos-slides').carouFredSel({
                                            auto: true,
                                            width: '100%',
                                            prev: '.logos-slider .prev',
                                            next: '.logos-slider .next',
                                            swipe: {
                                                onTouch: true
                                            },
                                            scroll : {
                                                items     : 1,
                                                duration  :	500				}
                                        });
                                    });

                                    $('.bwWrapper').BlackAndWhite({
                                        hoverEffect : true, // default true
                                        // set the path to BnWWorker.js for a superfast implementation
                                        webworkerPath : false,
                                        // for the images with a fluid width and height
                                        responsive:true,
                                        speed: { //this property could also be just speed: value for both fadeIn and fadeOut
                                            fadeIn: 200, // 200ms for fadeIn animations
                                            fadeOut: 300 // 800ms for fadeOut animations
                                        }
                                    });

                                    $("a.bwWrapper[href='#']").click(function(){ return false })

                                });
                            </script>


                        </div>
                        <!-- START COMMENTS -->
                        <div id="comments"></div>
                        <!-- END COMMENTS -->
                    </div>
                    <!-- END CONTENT -->

                    <!-- START EXTRA CONTENT -->
                    <!-- END EXTRA CONTENT -->

                </div>
            </div>
        </div>
        <!-- END PRIMARY -->
@endsection
