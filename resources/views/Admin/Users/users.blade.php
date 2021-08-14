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
                            <img src="/images/my/user.png" alt="title"/>
                        </div>
                        <div class="title-with-icon">
                            <h1>Пользователи</h1>
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
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">ИД</th>
                            <th scope="col">Логин</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Администратор</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <th scope="row">{{$user->id}}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @if($user->role == 1)
                                        <img src="/images/my/admin_active.png" alt="title"/>
                                    @elseif($user->role == 2)
                                        <img src="/images/my/super_admin.png" alt="title"/>
                                    @endif
                                </td>
                                <td>
                                    @if(Auth::check() && Auth::user()->role >= 2)
                                        @if($user->role != 2)
                                            <form action="{{route('admin_activate')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$user->id}}">
                                                <input type="hidden" name="role" value="{{$user->role}}">
                                                <button type="submit" class="btn   btn-friends-and-foes-2 ">
                                                    @if($user->role == 1)Сделать пользователем
                                                    @elseСделать администратором
                                                    @endif
                                                </button>
                                            </form>
                                        @else
                                            Супер Администратор
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    @if($user->role != 2)
                                        <a class="btn btn-ultraviolet-rays-1" href="{{route('post_edit', $user->id)}}"
                                           role="button">Редактировать</a>
                                    @else
                                        Супер Администратор
                                    @endif
                                </td>
                                <td>
                                    @if($user->role != 2)
                                        <form action="{{route('user_delete')}}" method="post">
                                            @csrf
                                            {{method_field('delete')}}
                                            <input type="hidden" name="id" value="{{$user->id}}">
                                            <button type="submit" class="btn btn-hem-5 ">Удалить</button>
                                        </form>
                                    @else
                                        Супер Администратор
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{--                    <div class='general-pagination group'>--}}
                    {{--                        @if($users->currentPage() !=1)--}}
                    {{--                            <a href='?page=1'>1</a>--}}
                    {{--                            <a href='{{$users->previousPageUrl()}}'><=</a>--}}
                    {{--                        @endif--}}
                    {{--                        @if($users->count()>1)--}}
                    {{--                            @for($count=1; $count<=$users->lastPage(); $count++)--}}
                    {{--                                @if($count > $users->currentPage()-3 and $count < $users->currentPage()+3)--}}
                    {{--                                    <a href='?page={{$count}}' @if($count==$users->currentPage()) class='selected' @endif>{{$count}}</a>--}}
                    {{--                                @endif--}}
                    {{--                            @endfor--}}
                    {{--                        @endif--}}
                    {{--                        @if($users->currentPage() != $users->lastPage())--}}
                    {{--                            <a href='{{$users->nextPageUrl()}}' >=></a>--}}
                    {{--                            <a href='?page={{$users->lastPage()}}'>{{$users->lastPage()}}</a>--}}
                    {{--                        @endif--}}
                    {{--                    </div>--}}
                </div>
                <!-- END CONTENT -->
                <!-- START EXTRA CONTENT -->
                <!-- END EXTRA CONTENT -->
            </div>
        </div>
    </div>
    <!-- END PRIMARY -->
@endsection
