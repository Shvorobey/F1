@extends('Layouts.layout')

@section('title', 'OOPS | 404')

@section('content')
</div>
<!-- END HEADER -->

<!-- START PRIMARY -->
<div id="primary" class="sidebar-no">
    <div class="container group">
        <div class="row">
            <!-- START CONTENT -->
            <div id="content-index" class="span12 content group">
                <img class="error-404-image group" src="/images/pages/403.png" title="Error 403" alt="403"/>
                <div class="error-404-text group">
                    <p>Сожалеем, но у Вас нет доступа к этой странице.<br/>Вы можете
                        <a href="{{route('index')}}">вернуться на главную страницу</a></p>
                </div>
            </div>
            <!-- END CONTENT -->
        </div>
    </div>
</div>
<!-- END PRIMARY -->
@endsection
