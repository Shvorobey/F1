@extends('Layouts.layout')

@section('title', 'F1 | Odessa')

@section('meta_keywords', 'F1, Odessa, formula 1, races, формула 1, клуб, Одесса, гонка')

@section('meta_description', 'Гонка формула 1, Formula 1 race')

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
            <div class="row">
                <!-- START CONTENT -->
                <div id="content-page" class="span12 content group">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Гонка</th>
                            <th scope="col">Актуальная</th>
                            <th scope="col">Старт</th>
                            <th scope="col">Результат</th>
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
                                    @if(count($race->raceResults)>0)
                                        <a class="btn btn-ultraviolet-rays-1" href="{{route('single_race_user', $race->id)}}"
                                           role="button">Результат</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- END CONTENT -->
            </div>
        </div>
    </div>
    <!-- END PRIMARY -->
@endsection


