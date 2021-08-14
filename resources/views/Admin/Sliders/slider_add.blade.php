@extends('Layouts.layout')

@section('title', 'F1 | Odessa')

@section('content')
    <!-- END HEADER -->
    <!-- START PAGE META -->
    <div id="page-meta" class="group">
        <div class="container">
            <div class="row">
                <div class="span12">
                    <!-- TITLE -->
                    <div class="title">
                        <div class="icontitle">
                            <img src="/images/my/sliders.png" alt="title"/>
                        </div>
                        <div class="title-with-icon">
                            <h1>Добавить слайды на главную страницу</h1>
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
            @if(\Session::has('flash'))
                <div class="box success-box">
                    {{\Session::get('flash')}}
                </div>
            @endif
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="box error-box">
                        {{ $error }}
                    </div>
                @endforeach
            @endif
            <div class="row">
                <!-- START CONTENT -->
                <div id="content-page" class="span12 content group">
                    <form action="{{route('slider_save')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label style="color: gold">Изображение 150 X 150</label>
                            <input type="file" name="small_image">
                        </div>
                        <div class="form-group">
                            <label style="color: gold">Изображение 1920 X 400</label>
                            <input type="file" name="big_image">
                        </div>
                        <div class="form-group">
                            <label style="color: gold">Заголовок</label>
                            <input class="span12" type="text" name="title" placeholder="Введите заголовок слайда"
                                   value="{{old('title')}}">
                        </div>
                        <div class="form-group col-md-12">
                            <label style="color: gold">Текст</label>
                            <textarea class="span12 form-control tinymce-editor" name="text">{{old('text')}}</textarea>
                        </div>
                        <button type="submit" class="btn btn-ultraviolet-rays-1">Сохранить</button>
                    </form>
                </div>
                <!-- END CONTENT -->
                <!-- START EXTRA CONTENT -->
                <!-- END EXTRA CONTENT -->
            </div>
        </div>
    </div>
    <!-- END PRIMARY -->
@endsection
