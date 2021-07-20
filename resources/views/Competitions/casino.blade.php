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
                            <img src="/images/pages/casino_c.png" alt="title"/>
                        </div>
                        <div class="title-with-icon">
                            <h1>{{$competition->name}}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE META -->

    <!-- START PRIMARY -->
    <div id="primary" class="sidebar-right">
        <label class="container group">
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
            @if(Auth::check())
                @if($stop)
                    <label style="color: gold"> Сделайте свою ставку на гонку
                        <strong style="color: red">{{$race->name}}</strong>
                    </label>
                    <label style="color: gold">Ставку можно сделать или изменить до :
                        <strong style="color: red">{{date('H:i:00 / d.m.Y', strtotime($stop_date))}}</strong>
                    </label>
                @else
                    <label style="color: gold">Ставки больше не принимаются! Время окончания приема ставок:
                        <strong style="color: red">{{date('H:i:00 / d.m.Y', strtotime($stop_date))}}</strong>
                    </label>
                @endif
                @if(!empty($bet_pilot))
                    <label style="color: deepskyblue">Вы уже сделали ставку на эту гонку. Ваша ставка: <strong
                            style="color: red">{{$bet_pilot->name}}</strong> </label>
                @else
                    <label style="color: deepskyblue">Вы еще не делали ставку на эту гонку.</label>

                @endif
                <hr>

                @if($stop)
                    <form method="post" action="{{route('bet_save')}}">
                        @csrf
                        <div class="input-group mb-3">
                            <label style="color: gold">Выберите пилота из списка</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="pilot">
                                @foreach($pilots as $pilot)
                                    <option value="{{$pilot['id']}}">{{$pilot['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="race" value="{{$competition->id}}">
                        <input type="submit" class="btn btn-warning" value="Сделать ставку">
                    </form>
                @else
                    <div class="row">
                        <div id="content-page" class="span9 content group">
                            <label style="color: red">Гонка скоро начнется или уже началась.<br> Ставки больше не
                                принимаются! Изменить ставку также больше нельзя!</label>
                        </div>
                    </div>
                @endif
            @else
                <div class="row">
                    <div id="content-page" class="span9 content group">
                        <label style="color: red"> Зарегистрируйтесь или войдите в свой аккаунт чтобы иметь возможность
                            делать ставки в казино</label>
                    </div>
                </div>
                <hr>
        @endif
    </div>
    </div>
    <!-- END PRIMARY -->
@endsection

