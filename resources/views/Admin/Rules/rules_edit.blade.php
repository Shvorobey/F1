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
                    <form method="post" action="{{route('race_edit', $race->id)}}">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="color: gold"
                                      id="inputGroup-sizing-default">Гонка:</span>
                                <input type="text" name="name" class="span7 form-control" aria-label="name"
                                       aria-describedby="inputGroup-sizing-default" value="{{$race->name}}">
                            </div>
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="color: gold"
                                      id="inputGroup-sizing-default">Старт:</span>
                                <input type="datetime-local" name="start" step="600" min="2021-06-07T00:00"
                                       max="2050-06-14T00:00"
                                       value="{{$race->start}}">
                            </div>
                            <input type="hidden" name="id" value="{{$race->id}}">
                        </div>
                        <br>
                        <input type="submit" class="btn btn-warning" value="Сохранить">
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
