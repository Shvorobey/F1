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
                            <img src="/images/my/partners.png" alt="title"/>
                        </div>
                        <div class="title-with-icon">
                            <h1>Партнеры</h1>
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
                <a class="btn btn-warning" href="{{route('partners_add')}}" role="button">+ Добавить</a>
            <hr>
            <div class="row">
                <!-- START CONTENT -->
                <div id="content-page" class="span12 content group">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Имя</th>
                            <th scope="col">Лого</th>
                            <th scope="col">Ссылка</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($partners as $partner)
                            <tr>
                                <th scope="row">{{$partner->name}}</th>
                                <td>
                                    <a href="{{$partner->link}}">{{$partner->link}}</a>
                                </td>
                                <td>
                                    <img alt="Логотип" width="35" height="35" src="/images/slider/{{$partner->image}}" />
                                </td>
                                <td>
                                    <a class="btn btn-ultraviolet-rays-1"
                                       href="{{route('partner_edit', $partner->id)}}" role="button">Редактировать</a>
                                </td>
                                <td>
                                    <form action="{{route('partners')}}" method="post">
                                        @csrf
                                        {{method_field('delete')}}
                                        <input type="hidden" name="id" value="{{$partner->id}}">
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


