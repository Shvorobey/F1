<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" class="ie" lang="ru">
<![endif]-->
<!--[if IE 7]>
<html id="ie7" class="ie" lang="ru">
<![endif]-->
<!--[if IE 8]>
<html id="ie8" class="ie" lang="ru">
<![endif]-->
<!--[if IE 9]>
<html id="ie9" class="ie" lang="ru">
<![endif]-->
<!--[if gt IE 9]>
<html class="ie" lang="ru">
<![endif]-->
<!-- This doesn't work but i prefer to leave it here... maybe in the future the MS will support it... i hope... -->
<!--[if IE 10]>
<html id="ie10" class="ie" lang="ru">
<![endif]-->
<!--[if !IE]>
<html lang="ru">
<![endif]-->

<!-- START HEAD -->
<head>
    <meta charset="UTF-8"/>

    <!-- this line will appear only if the website is visited with an iPad -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.2, user-scalable=yes"/>

    <title>@yield('title')</title>

    <!-- RESET STYLESHEET -->
    <link rel="stylesheet" type="text/css" media="all" href="/css/reset.css"/>
    <!-- BOOTSTRAP STYLESHEET -->
    <link rel="stylesheet" type="text/css" media="all" href="/css/bootstrap.css"/>
    <!-- MAIN THEME STYLESHEET -->
    <link rel="stylesheet" type="text/css" media="all" href="/style.css"/>

    <!-- [favicon] begin -->
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico"/>
    <link rel="icon" type="image/x-icon" href="/favicon.ico"/>
    <!-- [favicon] end -->

    <!-- Touch icons more info: http://mathiasbynens.be/notes/touch-icons -->
    <!-- For iPad3 with retina display: -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/apple-touch-icon-144x.png"/>
    <!-- For first- and second-generation iPad: -->
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/apple-touch-icon-114x.png"/>
    <!-- For first- and second-generation iPad: -->
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/apple-touch-icon-72x.png">
    <!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
    <link rel="apple-touch-icon-precomposed" href="/apple-touch-icon-57x.png"/>
    <link rel='stylesheet' id='thickbox-css' href='/js/thickbox/thickbox.css' type='text/css' media='all'/>
    <link rel='stylesheet' id='usquare-css-css' href='/sliders/usquare/css/frontend/usquare_style.css' type='text/css'
          media='all'/>
    <link rel='stylesheet' id='google-fonts-css'
          href='http://fonts.googleapis.com/css?family=Playfair+Display%7COpen+Sans+Condensed%3A300%7COpen+Sans%7CShadows+Into+Light%7CMuli%7CDroid+Sans%7CArbutus+Slab%7CAbel&#038;ver=3.5.1'
          type='text/css' media='all'/>
    <link rel='stylesheet' id='responsive-css' href='/css/responsive.css' type='text/css' media='all'/>
    <link rel='stylesheet' id='polaroid-slider-css' href='/sliders/polaroid/css/polaroid.css' type='text/css'
          media='all'/>
    <link rel='stylesheet' id='blog-libra-big-css'  href='blog/libra-small/css/style.css' type='text/css' media='all' />
    <link rel='stylesheet' id='ahortcodes-css' href='/css/shortcodes.css' type='text/css' media='all'/>
    <link rel='stylesheet' id='contact-form-css' href='/css/contact_form.css' type='text/css' media='all'/>
    <link rel='stylesheet' id='custom-css' href='/css/custom.css' type='text/css' media='all'/>

    <style type="text/css">
        body {
            background-color: #ffffff;
            background-image: url('/images/bg-pattern.png');
            background-repeat: repeat;
            background-position: top left;
            background-attachment: scroll;
        }
    </style>
    <script type='text/javascript' src='/js/jquery/jquery.js'></script>
</head>

<!-- END HEAD -->
<!-- START BODY -->
<body class="home page no_js responsive stretched">

<!-- START BG SHADOW -->
<div class="bg-shadow">

    <!-- START WRAPPER -->
    <div id="wrapper" class="container group">

        <!-- START TOP BAR -->
        <div id="topbar">
            <div class="container">
                <div class="row">
                    <div id="nav" class="span12 light">

                        <!-- START MAIN NAVIGATION -->

                        <ul id="menu-menu" class="level-1">
                            <li>
                                <a href="{{route('index')}}">HOME</a>
                            </li>
                            <li>
                                <a href="#">РЕГЛАМЕНТЫ</a>
                                <ul class="sub-menu">
                                    @inject('competitions', '\App\Competition')
                                    @foreach($competitions->getCompetition() as $competition)
                                        <li>
                                            <a href="{{route('rule', $competition->key)}}">{{$competition->name}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li>
                                <a href="#">АДМИНКА</a>
                                <ul class="sub-menu">
                                    <li><a href="{{route('pilots')}}">Пилоты</a></li>
                                    <li><a href="{{route('social_networks')}}">Соц. сети</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{route('posts')}}">БЛОГ</a>
                                <ul class="sub-menu">
                                    <li><a href="{{route('posts')}}">Блог</a></li>
                                </ul>
                            </li>
                            <div id="topbar_login" class="not_logged_in">
                                <li>
                                    <a class="nav-link" style="color: gold"
                                       href="{{route('home')}}">@if(\Illuminate\Support\Facades\Auth::check())<strong>{{\Illuminate\Support\Facades\Auth::user()->name}}</strong>
                                        @else Вход / Регистрация @endif</a>
                                </li>
                                @if(\Illuminate\Support\Facades\Auth::check())
                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit()"><strong style="color: greenyellow">Log out</strong></a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
                                        @csrf
                                    </form>
                                </li>
                                @endif
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- END TOP BAR -->

        <!-- START HEADER -->
        <div id="header" class="group margin-bottom">

            <div class="group container">
                <div class="row" id="logo-headersidebar-container">
                    <!-- START LOGO -->
                    <div id="logo" class="span6 group">
                        <a id="logo-img" href="{{route('index')}}" title="F1">
                            <img src="/images/F1_logo1.png" title="F1" alt="F1"/>
                        </a>
                        <p id='tagline'>Показать величайшее гоночное зрелище на планете</p>
                    </div>
                    <!-- END LOGO -->

                    <!-- START HEADER SIDEBAR -->
                    <div id="header-sidebar" class="span6 group">
                        <div class="widget-first widget header-text-image">
                            <div class="text-content">
                                <h3>Мы в социальных сетях</h3>
                            </div>
                        </div>

                        <div class="widget-last widget widget_text">
                            <div class="textwidget">
                                @inject('networks', '\App\SocialNetwork')

                                @foreach($networks->getSocialNetworks() as $network)
                                    <div class="socials-square-small {{$network->key}}-small default">
                                        <a href="{{$network->link}}" title="{{$network->name}}" target="_blank" class="socials-square-small default {{$network->key}}">{{$network->name}}</a>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        @yield('content')

        <!-- START FOOTER -->
            <div id="footer">
                <div class="container">
                    <div class="row">
                        <div class="footer-widgets-area with-sidebar-right">
                            <div class="widget-first widget span10 widget_text"><h3>About us</h3>
                                <div class="textwidget">
                                    Aliquam pellentesque pellentesque turpis, ut <a href="#">bibendum sapien</a>
                                    sollicitudin nec
                                    plasiren.
                                    Pellentesque posuere ornare placerat. Suspendisse potenti.
                                </div>
                            </div>
                            <div class="widget-last widget span2 widget_nav_menu">
                                <h3>Мы в соц. сетях</h3>
                                <div class="menu-socialize-container">
                                    <ul id="menu-socialize" class="menu">
                                        @foreach($networks->getSocialNetworks() as $network)
                                            <li class="menu-item menu-item-type-custom">
                                                <a href="{{$network->link}}">{{$network->name}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END FOOTER -->

            <!-- START COPYRIGHT -->
            <div id="copyright">
                <div class="container">
                    <div class="row">
                        <div class="center">
                            <p>
                                Copyright
                                &copy;<strong style="color: black"> ALEX SHVOROBEY </strong> 2021
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END COPYRIGHT -->

            <div class="wrapper-border"></div>

        </div>
        <!-- END WRAPPER -->

    </div>
    <!-- END BG SHADOW -->

    <script type='text/javascript' src='/js/comment-reply.min.js'></script>
    <script type='text/javascript' src='/js/underscore.min.js'></script>
    <script type='text/javascript' src='/js/jquery/jquery.masonry.min.js'></script>
    <script type='text/javascript' src='/sliders/polaroid/js/jquery.polaroid.js'></script>
    <script type='text/javascript' src='/js/jquery.colorbox-min.js'></script>
    <script type='text/javascript' src='/js/jquery.easing.js'></script>
    <script type='text/javascript' src='/js/jquery.yit_faq.js'></script>
    <script type='text/javascript' src='/js/jquery.carouFredSel-6.1.0-packed.js'></script>
    <script type='text/javascript' src='/js/jQuery.BlackAndWhite.js'></script>
    <script type='text/javascript' src='/js/jquery.touchSwipe.min.js'></script>
    <script type='text/javascript' src='/sliders/polaroid/js/jquery.transform-0.8.0.min.js'></script>
    <script type='text/javascript' src='/sliders/polaroid/js/jquery.preloader.js'></script>
    <script type='text/javascript' src='/js/responsive.js'></script>
    <script type='text/javascript' src='/js/mobilemenu.js'></script>
    <script type='text/javascript' src='/js/jquery.colorbox-min.js'></script>
    <script type='text/javascript' src='/js/jquery.superfish.js'></script>
    <script type='text/javascript' src='/js/jquery.placeholder.js'></script>
    <script type='text/javascript' src='/js/contact.js'></script>
    <script type='text/javascript' src='/js/jquery.tipsy.js'></script>
    <script type='text/javascript' src='/js/jquery.cycle.min.js'></script>
    <script type='text/javascript' src='/js/shortcodes.js'></script>
    <script type='text/javascript' src='/js/jquery.custom.js'></script>
    <script type='text/javascript' src='/js/hoverIntent.min.js'></script>
    <script type='text/javascript' src='/js/media-upload.min.js'></script>
    <script type='text/javascript' src='/js/jquery.clickout.min.js'></script>
    <script type='text/javascript' src='/js/responsive.js'></script>
    <script type='text/javascript' src='/js/mobilemenu.js'></script>
    <script type='text/javascript' src='/js/jquery.superfish.js'></script>
    <script type='text/javascript' src='/js/jquery.colorbox-min.js'></script>
    <script type='text/javascript' src='/js/jquery.placeholder.js'></script>
    <script type='text/javascript' src='/js/contact.js'></script>
    <script type='text/javascript' src='/js/jquery.tweetable.js'></script>
    <script type='text/javascript' src='js/comment-reply.min.js'></script>
    <script type='text/javascript' src='js/underscore.min.js'></script>
    <script type='text/javascript' src='js/jquery/jquery.masonry.min.js'></script>
    <script type='text/javascript' src='js/jquery.easing.js'></script>
    <script type='text/javascript' src='js/hoverIntent.min.js'></script>
    <script type='text/javascript' src='js/media-upload.min.js'></script>
    <script type='text/javascript' src='js/jquery.clickout.min.js'></script>
    <script type='text/javascript' src='js/responsive.js'></script>
    <script type='text/javascript' src='js/mobilemenu.js'></script>
    <script type='text/javascript' src='js/jquery.superfish.js'></script>
    <script type='text/javascript' src='js/jquery.colorbox-min.js'></script>
    <script type='text/javascript' src='js/jquery.placeholder.js'></script>
    <script type='text/javascript' src='js/contact.js'></script>
    <script type='text/javascript' src='js/jquery.tweetable.js'></script>
    <script type='text/javascript' src='js/jquery.tipsy.js'></script>
    <script type='text/javascript' src='js/jquery.cycle.min.js'></script>
    <script type='text/javascript' src='js/shortcodes.js'></script>
    <script type='text/javascript' src='js/jquery.custom.js'></script>
</body>
<!-- END BODY -->
</html>
