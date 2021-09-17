@extends('Layouts.layout')

@section('title', 'F1 | Odessa')

@section('meta_keywords', 'F1, Odessa, formula 1, rules, формула 1, клуб, Одесса, правила')

@section('meta_description', 'Правила соревнований, Competition rules')

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
                    </div>
                    <!-- END CONTENT -->

                    <!-- START SIDEBAR -->
                    <div id="sidebar-homeiv" class="span3 sidebar group">
                        <div class="widget-first widget widget-icon-text group">
                            <img class="imgicon" src="/images/emotion_smile.png" alt=""/>
                            <h3>Выигрывает только тот</h3> <p>кто участвует.</p>
                        </div>
                    </div>
                    <!-- END SIDEBAR -->
                </div>
            </div>
        </div>
        <!-- END PRIMARY -->
@endsection

