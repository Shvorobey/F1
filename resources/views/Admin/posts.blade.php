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
                            <img src="/images/my/posts.png" alt="title"/>
                        </div>
                        <div class="title-with-icon">
                            <h1>Посты</h1>
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
                <a class="btn btn-warning" href="{{route('post_add')}}" role="button">+ Добавить</a>
            <hr>
            <div class="row">
                <!-- START CONTENT -->
                <div id="content-page" class="span12 content group">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">ИД</th>
                            <th scope="col">Каринка</th>
                            <th scope="col">Заголовок</th>
                            <th scope="col">Просмотры</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <th scope="row">{{$post->id}}</th>
                                <td><img width="100" height="75" src="/images/blog/{{$post->image}}" class="attachment-blog_thumb wp-post-image" alt="23" />
                                <td>{{$post->title}}</td>
                                <td>{{$post->views}}</td>
                                    <td>
                                        <a class="btn btn-ultraviolet-rays-1" href="{{route('post_edit', $post->id)}}" role="button">Редактировать</a>
                                    </td>
                                <td>
                                    <form action="{{route('post_delete')}}" method="post">
                                        @csrf
                                        {{method_field('delete')}}
                                        <input type="hidden" name="id" value="{{$post->id}}">
                                        <button type="submit" class="btn btn-hem-5 ">Удалить</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class='general-pagination group'>
                        @if($posts->currentPage() !=1)
                            <a href='?page=1'>1</a>
                            <a href='{{$posts->previousPageUrl()}}'><=</a>
                        @endif
                        @if($posts->count()>1)
                            @for($count=1; $count<=$posts->lastPage(); $count++)
                                @if($count > $posts->currentPage()-3 and $count < $posts->currentPage()+3)
                                    <a href='?page={{$count}}' @if($count==$posts->currentPage()) class='selected' @endif>{{$count}}</a>
                                @endif
                            @endfor
                        @endif
                        @if($posts->currentPage() != $posts->lastPage())
                            <a href='{{$posts->nextPageUrl()}}' >=></a>
                            <a href='?page={{$posts->lastPage()}}'>{{$posts->lastPage()}}</a>
                        @endif
                    </div>
                </div>
                <!-- END CONTENT -->
                <!-- START EXTRA CONTENT -->
                <!-- END EXTRA CONTENT -->
            </div>
        </div>
    </div>
    <!-- END PRIMARY -->
@endsection

