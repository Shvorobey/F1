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
                            <img src="/images/my/social_networks.png" alt="title"/>
                        </div>
                        <div class="title-with-icon">
                            <h1>Мы в социальных сетях</h1>
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
                <form method="post" action="{{route('social_networks')}}">
                    @csrf
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="color: gold" id="inputGroup-sizing-default">Название:</span>
                            <input type="text" name="name" class="form-control" aria-label="name"
                                   aria-describedby="inputGroup-sizing-default" value="{{old('name')}}">
                            <span class="input-group-text" style="color: gold" id="inputGroup-sizing-default"> Ссылка:</span>
                            <input type="text" name="link" class="span8" value="{{old('link')}}">
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
                            <th scope="col">Ссылка</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($social_networks as $social_network)
                            <tr>
                                <th scope="row">{{$social_network->name}}</th>
                                <td>
                                    <a href="{{$social_network->link}}">{{$social_network->link}}</a>
                                </td>
                                <td>
                                    <a class="btn btn-ultraviolet-rays-1"
                                       href="{{route('social_network_edit', $social_network->id)}}" role="button">Редактировать</a>
                                </td>
                                <td>
                                    <form action="{{route('social_networks')}}" method="post">
                                        @csrf
                                        {{method_field('delete')}}
                                        <input type="hidden" name="id" value="{{$social_network->id}}">
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

