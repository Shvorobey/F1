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
                            <img src="/images/pages/forecast.png" alt="title"/>
                        </div>
                        <div class="title-with-icon">
                            <h1>{{$name}}</h1>
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
            <form method="post" action="{{route('pilot_add')}}">
                @csrf
                <div class="input-group mb-3">
                    <label style="color: gold" >Выберите пилота из списка</label>
                    <select class="form-control" id="exampleFormControlSelect1">
                        @foreach($pilots as $pilot)
                            <option value="{{$pilot->id}}">{{$pilot->name}}</option>
                        @endforeach
                    </select>
                </div>
                <input type="submit" class="btn btn-warning" value="+ Добавить">
            </form>
            <hr>
            <div class="row">
                <!-- START CONTENT -->
                <div id="content-page" class="span9 content group">

                </div>
                <!-- END CONTENT -->
                <!-- START EXTRA CONTENT -->
                <!-- END EXTRA CONTENT -->
            </div>
        </div>
    </div>
    <!-- END PRIMARY -->
@endsection
