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
                            <img src="/images/pages/faq1.png" alt="title"/>
                        </div>
                        <div class="title-with-icon">
                            <h1>Разделы правил</h1>
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
            @if(\Session::has('flash_error'))
                <div class="box error-box">
                    {{\Session::get('flash_error')}}
                </div>
            @endif
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="box error-box">
                        {{ $error }}
                    </div>
                @endforeach
            @endif
            <hr>
            <div class="row">
                <!-- START CONTENT -->
                <div id="content-page" class="span12 content group">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Заголовок</th>
                            <th scope="col">Новый заголовок</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rules as $rule)
                            <tr>
                                <td>{{$rule->paragraph}}</td>
                                <form action="{{route('pilot_edit')}}" method="post">
                                    <td>
                                        @csrf
                                        <input type="hidden" name="id" value="{{$rule->id}}">
                                        <input type="text" name="name">
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-ultraviolet-rays-1 ">Сохранить</button>
                                    </td>
                                </form>
                                <td>
                                    <form action="{{route('pilots')}}" method="post">
                                        @csrf
                                        {{method_field('delete')}}
                                        <input type="hidden" name="id" value="{{$rule->id}}">
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
