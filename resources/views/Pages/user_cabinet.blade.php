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
                            <h1>{{$user->name}}</h1>
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
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>ЛОГИН</td>
                                <td><strong>{{$user->name}}</strong></td>
                            </tr>
                            <tr>
                                <td>E-MAIL</td>
                                <td><strong>{{$user->email}}</strong></td>
                            </tr>
                            <tr>
                                <td>ЗАРЕГИСТРИРОВАН</td>
                                <td><strong>{{$user->created_at}}</strong></td>
                            </tr>
                            <tr>
                                <td>ПОСЛЕДНЕЕ ОБНОВЛЕНИЕ</td>
                                <td><strong>{{$user->updated_at}}</strong></td>
                            </tr>
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


