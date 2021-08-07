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
                                Результаты гонки <strong style="color: gold"> {{$race->name}} </strong>
                                (Старт <strong style="color: gold"> {{date('d.m.Y в G:i', strtotime($race->start))}})</strong>
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
            <div class="row">
                <!-- START CONTENT -->
                <div id="content-page" class="span12 content group">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Позиция</th>
                                <th scope="col">Пилот</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($results as $result)
                                <tr>
                                    <td>
                                        {{$result->place}}
                                    </td>
                                    <th scope="row">{{$result->pilot->name}}</th>
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

