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
                            <img height="50" width="50" src="/images/avatars/{{$user->avatar}}" alt="title"/>
                        </div>
                        <div class="title-with-icon">
                            <h1>Редактировать информацию пользователя {{$user->name}}</h1>
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
                @if(\Session::has('flash_p'))
                    <div class="box success-box">
                        {{\Session::get('flash_p')}}
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
                    <form action="{{route('user_save_edit')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label style="color: gold">Логин</label>
                            <input type="text" name="name" class="span12" value="{{$user->name}}">
                        </div>
                        <div class="form-group col-md-9">
                            <label style="color: gold">E-mail</label>
                            <input type="text" name="email" class="span12" value="{{$user->email}}">
                        </div>
                        <hr>
                        <p>Если хотите изменить пароль - заполните поля ниже.</p>
                        <p>Если поля ниже остануться пустыми, то пароль не измениться.</p>
                        <div class="form-group col-md-9">
                            <label style="color: gold">Старый пароль</label>
                            <input type="password" name="current_password" class="span12">
                        </div>
                        <div class="form-group col-md-9">
                            <label style="color: gold">Новый пароль</label>
                            <input type="password" name="new_password" class="span12">
                        </div>
                        <div class="form-group col-md-9">
                            <label style="color: gold">Еще раз новый пароль</label>
                            <input type="password" name="new_password_confirmation" class="span12">
                        </div>
                        <div class="form-group">
                            <label style="color: gold">Аватарка</label>
                            <input type="file" name="avatar">
                        </div>
                        <button type="submit" class="btn btn-ultraviolet-rays-1">Сохранить</button>
                    </form>
                </div>
                <!-- END CONTENT -->
            </div>
        </div>
    </div>
    <!-- END PRIMARY -->
@endsection
