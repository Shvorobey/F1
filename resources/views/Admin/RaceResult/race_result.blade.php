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
                            <img src="/images/my/race_result.png" alt="title"/>
                        </div>
                        <div class="title-with-icon">
                            <h1>
                                Результаты гонки <strong style="color: gold"> {{$race->name}}</strong>
                            </h1>
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
                    <form method="post" action="{{route('race_result')}}">
                        @csrf
                        <input type="hidden" name="race_id" value="{{$race->id}}">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="color: gold" id="inputGroup-sizing-default"><b> Полу-позишн : </b></span>
                            <select  name = "pole_position">
                                @foreach($pilots as $pilot)
                                <option value="{{$pilot->id}}">{{$pilot->name}}</option>
                                @endforeach
                            </select>
                            <span class="input-group-text" style="color: gold" id="inputGroup-sizing-default"><b> Лучший круг : </b></span>
                            <select  name = "fastest_lap">
                                @foreach($pilots as $pilot)
                                    <option value="{{$pilot->id}}">{{$pilot->name}}</option>
                                @endforeach
                            </select>
                </div>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Пилот</th>
                                <th scope="col">Позиция</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pilots as $pilot)
                                <tr>
                                    <th scope="row">{{$pilot->name}}</th>
                                    <td>
                                        <input type="number" name="place [{{$pilot->id}}]" min="0" max="100" required>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-warning">Сохранить</button>
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


