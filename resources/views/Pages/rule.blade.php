@extends('Layouts.layout')
@section('title', 'F1 | Odessa')
@section('content')
        </div>
        <!-- END HEADER -->
        <!-- START PAGE META -->
        <div id="page-meta" class="group">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <!-- TITLE -->
                        <div class="title">
                            <div class="icontitle">
                                <img src="/images/pages/faq1.png" alt="title"/>
                            </div>
                            <div class="title-with-icon">
                                <h1>Регламент конкурса "{{$competition->name}}"</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE META -->

        <!-- START PRIMARY -->
        <div id="primary" class="sidebar-right">
            <div class="container group">
                <div class="row">
                    <!-- START CONTENT -->
                    <div id="content-page" class="span9 content group">
                        <div class="page type-page status-publish group">
                            <div id="faqs-container">
                                @foreach($rules as $rule)
                                    <div class="faq-wrapper all support ">
                                        <div class="faq-title 9">
                                            <div class="plus"></div>
                                            <h4>{{$rule->paragraph}}</h4>
                                        </div>
                                        <div class="faq-item 9">
                                            <div class="faq-item-content">
                                            @foreach($rule->points as $point)
                                                <p>{{$point->text}}</p>
                                            @endforeach
                                        </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <script>
                                jQuery(document).ready(function ($){
                                    $('#faqs-container').yit_faq();
                                })
                            </script>

                        </div>
                        <!-- START COMMENTS -->
                        <div id="comments">
                        </div>
                        <!-- END COMMENTS -->
                    </div>
                    <!-- END CONTENT -->

                    <!-- START SIDEBAR -->
                    <div id="sidebar-homeiv" class="span3 sidebar group">
                        <div class="widget-first widget widget-icon-text group">
                            <img class="imgicon" src="/images/emotion_smile.png" alt=""/>

                            <h3>We will make you happy</h3>

                            <p>Duis aute irure dolor in moris.</p>

                        </div>
                        <div class="widget widget-icon-text group">
                            <img class="imgicon" src="/images/phone5.png" alt=""/>

                            <h3>Contact us</h3>

                            <p>Call us + 39 095 3826830</p>
                        </div>
                        <div class="widget-last widget widget-icon-text group">
                            <img class="imgicon" src="/images/flower.png" alt=""/>

                            <h3>We&#8217;re kind!</h3>

                            <p>..and do you love us?</p>

                        </div>
                    </div>
                    <!-- END SIDEBAR -->

                    <!-- START EXTRA CONTENT -->
                    <!-- END EXTRA CONTENT -->
                </div>
            </div>
        </div>
        <!-- END PRIMARY -->
@endsection

