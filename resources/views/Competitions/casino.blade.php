@extends('Layouts.layout')

@section('title', 'F1 | Odessa')

@section('content')
    <link rel='stylesheet' id='custom-css' href='/css/timer.css' type='text/css' media='all'/>
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
                    @if(!$stop)
                <h3 class="countdown-title">До окончания приема ставок</h3>
                <div id="countdown" class="countdown">
                    <div class="countdown-number">
                        <span class="days countdown-time"></span>
                        <span class="countdown-text">Дней</span>
                    </div>
                    <div class="countdown-number">
                        <span class="hours countdown-time"></span>
                        <span class="countdown-text">Часов</span>
                    </div>
                    <div class="countdown-number">
                        <span class="minutes countdown-time"></span>
                        <span class="countdown-text">Минут</span>
                    </div>
                    <div class="countdown-number">
                        <span class="seconds countdown-time"></span>
                        <span class="countdown-text">Секунд</span>
                    </div>
                    <div id="deadline-message" class="deadline-message">
                        Ставки больше не принимаются!
                    </div>
                </div>
<hr>
                    <h1 style="color: gold">Вы можете сделать ставку на гонку
                        <strong style="color: red">{{$race->name}}</strong>
                    </h1>
                    <h2 style="color: gold">Ставку можно сделать или изменить до :
                        <strong style="color: red">{{date('H:i:00 / d.m.Y', strtotime($stop_date))}}</strong>
                    </h2>
                @else
                    <label style="color: gold">Ставки больше не принимаются! Время окончания приема ставок:
                        <strong style="color: red">{{date('H:i:00 / d.m.Y', strtotime($stop_date))}}</strong>
                    </label>
                @endif
                @if(!empty($bet_pilot))
                    <h3 style="color: gold">Вы уже сделали ставку на эту гонку. Ваша ставка: <strong
                            style="color: red">{{$bet_pilot->name}}</strong> </h3>
                @else
                    <label style="color: deepskyblue">Вы еще не делали ставку на эту гонку.</label>

                @endif
                <hr>

                @if(!$stop)
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
                        <input type="hidden" name="race" value="{{$race->id}}">
                        <input type="hidden" id="finish" value="{{date('F d Y H:i:00', strtotime($stop_date)) . ' GMT+0300'}}">
                        <input type="submit" class="btn btn-warning" value="@if(!empty($bet_pilot))Изменить ставку@elseСделать ставку@endif">
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
    <script>
        function getTimeRemaining(endtime) {
            var t = Date.parse(endtime) - Date.parse(new Date());
            var seconds = Math.floor((t / 1000) % 60);
            var minutes = Math.floor((t / 1000 / 60) % 60);
            var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
            var days = Math.floor(t / (1000 * 60 * 60 * 24));
            return {
                'total': t,
                'days': days,
                'hours': hours,
                'minutes': minutes,
                'seconds': seconds
            };
        }

        function initializeClock(id, endtime) {
            var clock = document.getElementById(id);
            var daysSpan = clock.querySelector(".days");
            var hoursSpan = clock.querySelector(".hours");
            var minutesSpan = clock.querySelector(".minutes");
            var secondsSpan = clock.querySelector(".seconds");

            function updateClock() {
                var t = getTimeRemaining(endtime);

                if (t.total <= 0) {
                    document.getElementById("countdown").className = "hidden";
                    document.getElementById("deadline-message").className = "visible";
                    clearInterval(timeinterval);
                    return true;
                }

                daysSpan.innerHTML = t.days;
                hoursSpan.innerHTML = ("0" + t.hours).slice(-2);
                minutesSpan.innerHTML = ("0" + t.minutes).slice(-2);
                secondsSpan.innerHTML = ("0" + t.seconds).slice(-2);
            }

            updateClock();
            var timeinterval = setInterval(updateClock, 1000);
        }
        var deadline =  document.getElementById("finish").value; // for endless timer
        initializeClock('countdown', deadline);
    </script>

@endsection

