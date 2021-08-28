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
                            <h1>Слайды на главной странице</h1>
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
            <a class="btn btn-warning" href="{{route('slider_add')}}" role="button">+ Добавить</a>
            <hr>
            <div class="row">
                <!-- START CONTENT -->
                <div id="content-page" class="span12 content group">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Порядок</th>
                            <th scope="col">Активность</th>
                            <th scope="col">Позиция</th>
                            <th scope="col">Иконка</th>
                            <th scope="col">Заголовок</th>
                            <th scope="col">Текст</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sliders as $slider)
                            <tr>
                                <th scope="row">{{$slider->order}}</th>
                                <td>
                                    @if($slider->is_active == 1)
                                        <img src="/images/my/yes.jpg" alt="да"/>
                                    @else
                                        <img src="/images/my/no.jpg" alt="нет"/>
                                    @endif
                                </td>
                                <td>
                                    @if($slider->order != 1)
                                        <a href="{{route('slider_up', $slider->id)}}"><img src="/images/my/up.png" alt="Переместить вверх"/></a>
                                    @endif
                                    @if($slider->order != $max)
                                            <a href="{{route('slider_down', $slider->id)}}"> <img src="/images/my/down.png" alt="Переместить вниз"/> </a>
                                    @endif
                                </td>
                                <td>
                                    <img alt="Иконка" src="/images/slider/flexslider/{{$slider->small_image}}"/>
                                </td>
                                <td>
                                    {!! $slider->title !!}
                                </td>
                                <td>
                                    {!! $slider->text !!}
                                </td>
                                <td>
                                    <a class="btn btn-ultraviolet-rays-1" href="{{route('slider_edit', $slider->id)}}"
                                       role="button">Редактировать</a>
                                </td>
                                <td>
                                    <a class="btn btn-friends-and-foes-2"
                                       href="{{route('slider_deactivate', $slider->id)}}"
                                       role="button">
                                        @if($slider->is_active == 1)
                                            Деактивирвать
                                        @else
                                            Активировать
                                        @endif
                                    </a>
                                </td>
                                <td>
                                    <form action="{{route('sliders')}}" method="post">
                                        @csrf
                                        {{method_field('delete')}}
                                        <input type="hidden" name="id" value="{{$slider->id}}">
                                        <button type="submit" class="btn btn-hem-5 ">Удалить</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- END CONTENT -->
                <!-- START EXTRA CONTENT -->
                <!-- END EXTRA CONTENT -->
            </div>
        </div>
    </div>
    <!-- END PRIMARY -->
@endsection
