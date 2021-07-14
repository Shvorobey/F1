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
                            <img src="/images/my/race.png" alt="title"/>
                        </div>
                        <div class="title-with-icon">
                            <h1>Гонки</h1>
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
            <form method="post" action="{{route('race_add')}}">
                @csrf
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="color: gold" id="inputGroup-sizing-default">Гонка:</span>
                        <input type="text" name="name" class="span7 form-control" aria-label="name"
                               aria-describedby="inputGroup-sizing-default" value="{{old('name')}}">
                        <span class="input-group-text" style="color: gold" id="inputGroup-sizing-default">Старт:</span>
                        <input type="datetime-local" name="start" min="2021-06-07T00:00" max="2050-06-14T00:00">
                    </div>
                </div>
                <input type="submit" class="btn btn-warning" value="+ Добавить">
            </form>
            <hr>
            <div class="row">
                <!-- START CONTENT -->
                <div id="content-page" class="span12 content group">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Имя</th>
                            <th scope="col">Активность</th>
                            <th scope="col">Старт</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($races as $race)
                            <tr>
                                <th scope="row">{{$race->name}}</th>
                                <td>
                                    @if($race->is_active == 1)
                                        <img src="/images/my/yes.jpg" alt="title"/>
                                    @else
                                        <img src="/images/my/no.jpg" alt="title"/>
                                    @endif
                                </td>
                                    <td>
                                        <strong>{{date('d.m.Y в G:i', strtotime($race->start))}}</strong>
                                    </td>
                                    <td>
                                    <a class="btn btn-ultraviolet-rays-1" href="{{route('race_edit', $race->id)}}"
                                       role="button">Редактировать</a>
                                    </td>
                                <td>
                                    <a class="btn btn-ultraviolet-rays-1" href="{{route('race_activate', $race->id)}}"
                                       role="button">Сделать активной</a>
                                </td>
                                <td>
                                    <form action="{{route('race_delete')}}" method="post">
                                        @csrf
                                        {{method_field('delete')}}
                                        <input type="hidden" name="id" value="{{$race->id}}">
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


