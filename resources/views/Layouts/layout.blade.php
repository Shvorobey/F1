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
                                <ul class="sub-menu">
                                    <li><a href="/home-ii.html">Home II</a></li>
                                    <li><a href="/home-iii.html">Home III</a></li>
                                    <li><a href="/home-iv.html">Home IV</a></li>
                                    <li><a href="/home-v.html">Home V</a></li>
                                    <li><a href="/home-vi.html">Home VI</a></li>
                                    <li><a href="/home-vii.html">Home VII</a></li>
                                    <li><a href="/home-viii.html">Home VIII</a></li>
                                    <li><a href="/home-ix.html">Home IX</a></li>
                                    <li><a href="/home-x.html">Home X</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">SLIDERS</a>
                                <ul class="sub-menu">
                                    <li><a href="/revolution-slider.html">Revolution Slider</a></li>
                                    <li><a href="/flexslider-classic.html">Flexslider Classic</a></li>
                                    <li><a href="/flexslider-elegant.html">Flexslider Elegant</a></li>
                                    <li><a href="/elastic.html">Elastic</a></li>
                                    <li><a href="/flash.html">Flash</a></li>
                                    <li><a href="/rotating.html">Rotating</a></li>
                                    <li><a href="/thumbnails.html">Thumbnails</a></li>
                                    <li><a href="/usquare.html">Usquare</a></li>
                                    <li><a href="/polaroid.html">Polaroid</a></li>
                                </ul>
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
                                <a href="#">FEATURES</a>
                                <ul class="sub-menu">
                                    <li><a href="/services-module.html">Services Module</a></li>
                                    <li><a href="/blog-modules.html">Blog modules</a></li>
                                    <li><a href="/portfolio-and-video-modules.html">Portfolio and video modules</a></li>
                                    <li><a href="/libra-features.html">Libra features</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">PORTFOLIO</a>
                                <ul class="sub-menu">
                                    <li><a href="/portfolio-libra.html">Libra</a></li>
                                    <li><a href="/portfolio-pinterest.html">Pinterest</a></li>
                                    <li><a href="/portfolio-slide-detail.html">Slide Detail</a></li>
                                    <li><a href="/portfolio-filterable.html">Filterable</a></li>
                                    <li><a href="/portfolio-2-columns.html">2 Columns</a></li>
                                    <li><a href="/portfolio-3-columns.html">3 Columns</a></li>
                                    <li><a href="/portfolio-4-columns.html">4 Columns</a></li>
                                    <li><a href="/portfolio-big-image.html">Big Image</a></li>
                                    <li><a href="/portfolio-slider.html">Slider</a></li>
                                    <li><a href="/portfolio-project-detail-1.html">Project Detail #1</a></li>
                                    <li><a href="/portfolio-project-detail-2.html">Project detail #2</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">PAGES</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="testimonials.html">Testimonials</a></li>
                                    <li>
                                        <a href="#">Blog</a>
                                        <ul class="sub-menu">
                                            <li><a href="blog-libra-big.html">Libra Big</a></li>
                                            <li><a href="blog-libra-small.html">Libra Small</a></li>
                                            <li><a href="blog-elegant.html">Elegant</a></li>
                                            <li><a href="blog-big-thumbnails.html">Big Thumbnails</a></li>
                                            <li><a href="blog-small-thumbnails.html">Small Thumbnails</a></li>
                                            <li><a href="blog-pinterest.html">Pinterest</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="pages-faq.html">FAQ</a>
                                    </li>
                                    <li>
                                        <a href="#">About</a>
                                        <ul class="sub-menu">
                                            <li><a href="accordion-style.html">Accordion Style</a></li>
                                            <li><a href="circle-style.html">Circle Style</a></li>
                                            <li><a href="u-square-style.html">U-square style</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="error-404.html">Error 404</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">SHORTCODES</a>
                                <ul class="sub-menu">
                                    <li><a href="shortcodes-alert-box-buttons.html">Alert box &amp; Buttons</a></li>
                                    <li><a href="shortcodes-charts.html">Charts</a></li>
                                    <li><a href="shortcodes-icon-section.html">Icon section</a></li>
                                    <li><a href="shortcodes-media-widgets.html">Media &amp; Widgets</a></li>
                                    <li><a href="shortcodes-mix-various.html">Mix &amp; Various</a></li>
                                    <li><a href="shortcodes-table-box-prices.html">Table &amp; Box prices</a></li>
                                    <li><a href="shortcodes-typography.html">Typography</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">CONTACT</a>
                                <ul class="sub-menu">
                                    <li><a href="get-in-touch.html">With MAP</a></li>
                                    <li><a href="get-in-touch-2.html">Without MAP</a></li>
                                </ul>
                            </li>
                        </ul>
                        <!-- END MAIN NAVIGATION -->

                        <!-- START TOPBAR LOGIN -->

                        <div id="topbar_login" class="not_logged_in">

                            <a class="topbar_login" href="#">
                                LOGIN <span class="sf-sub-indicator"></span>
                            </a>

                            <div id="fast-login" class="access-info-box">
                                <form action="#" method="post" name="loginform">

                                    <div class="form">
                                        <p>
                                            <label>
                                                Username<br/>
                                                <input type="text" tabindex="10" size="20" value="" name="log"
                                                       class="input-text"/>
                                            </label>
                                        </p>

                                        <p>
                                            <label>
                                                Password<br/>
                                                <input type="password" tabindex="20" size="20" value="" name="pwd"
                                                       class="input-text"/>
                                            </label>
                                        </p>

                                        <a class="align-left lostpassword" href="#" title="Password Lost and Found">
                                            lost password?
                                        </a>

                                        <p class="align-right">
                                            <input type="submit" tabindex="100" value="Login" name="wp-submit"
                                                   class="input-submit"/>
                                            <input type="hidden" value="index.html" name="redirect_to"/>
                                            <input type="hidden" value="1" name="testcookie"/>
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- END TOPBAR LOGIN -->
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
                            <div class="widget-first widget span2 widget_text"><h3>About us</h3>
                                <div class="textwidget">
                                    Aliquam pellentesque pellentesque turpis, ut <a href="#">bibendum sapien</a>
                                    sollicitudin nec
                                    plasiren.
                                    Pellentesque posuere ornare placerat. Suspendisse potenti.
                                </div>
                            </div>

                            <div class="widget span2 widget_nav_menu">
                                <h3>A menu widget</h3>

                                <div class="menu-widget-footer-container">
                                    <ul id="menu-widget-footer" class="menu">
                                        <li class="menu-item menu-item-type-post_type menu-item-object-page">
                                            <a href="accordion-style.html">About</a>
                                        </li>

                                        <li class="menu-item menu-item-type-post_type">
                                            <a href="testimonials.html">Testimonials</a>
                                        </li>

                                        <li class="menu-item menu-item-type-post_type">
                                            <a href="portfolio-3-columns.html">Portfolio</a>
                                        </li>

                                        <li class="menu-item menu-item-type-post_type">
                                            <a href="get-in-touch.html">Get in touch</a>
                                        </li>

                                        <li class="menu-item menu-item-type-custom">
                                            <a href="#">Policy</a>
                                        </li>

                                        <li class="menu-item menu-item-type-custom">
                                            <a href="#">Utilities</a>
                                        </li>
                                    </ul>
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
                                <a href="http://yithemes.com/"><img
                                        src="http://yithemes.com/cdn/images/various/footer_yith_grey.png"
                                        alt="Your Inspiration Themes"
                                        style="position:relative; top:9px; margin: -22px 5px 0 0;"></a>&nbsp;Copyright
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

</body>
<!-- END BODY -->
</html>
