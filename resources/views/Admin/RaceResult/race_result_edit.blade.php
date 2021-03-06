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

            <div class="row">
                <!-- START CONTENT -->
                <div id="content-page" class="span12 content group">
                    <form method="post" action="{{route('race_result_single', $race->id)}}">
                        @csrf
                        <input type="hidden" name="race_id" value="{{$race->id}}">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="color: gold" id="inputGroup-sizing-default"><b> Полу-позишн : </b></span>
                            <select  name = "pole_position">
                                @foreach($results as $result)
                                    <option @if($result->pole_position == 1) selected @endif value="{{$result->pilot->id}}">{{$result->pilot->name}}</option>
                                @endforeach
                            </select>
                            <span class="input-group-text" style="color: gold" id="inputGroup-sizing-default"><b> Лучший круг : </b></span>
                            <select  name = "fastest_lap">
                                @foreach($results as $result)
                                    <option @if($result->fastest_lap == 1) selected @endif  value="{{$result->pilot->id}}">{{$result->pilot->name}}</option>
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
                            @foreach($results as $result)
                                <tr>
                                    <th scope="row">{{$result->pilot->name}}</th>
                                    <input type="hidden" name="pilot_id" value="{{$result->pilot_id}}">
                                    <td>
                                        <input type="number" name="result [{{$result->id}}]" value="{{$result->place}}"
                                               min="0" max="100" required>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-warning">Обновить</button>
                        <p align="right">
                            <a class="btn btn-hem-5" href="{{route('casino_counting',$race->id)}}" role="button">Рассчитать
                                результаты
                                прогнозов</a>
                        </p>

                    </form>
                </div>
                <!-- END CONTENT -->
            </div>
        </div>
    </div>
    <!-- END PRIMARY -->
@endsection
