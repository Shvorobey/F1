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
                            <h1>Редактировать пост</h1>
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
                    <form action="{{route('post_edit', $post->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{$post->id}}" name="id">
                        <div class="form-group">
                            <label style="color: gold" >Заголовок</label>
                            <input class="span12" type="text" name="title"  placeholder="Введите заголовок поста" value="{{$post->title}}">
                        </div>
                        <div class="form-group col-md-12">
                            <label style="color: gold">Текст поста</label>
                            <textarea class="form-control tinymce-editor" name="body">{{$post->body}}</textarea>
                        </div>
                        <div class="form-group">
                            <label style="color: gold" >Изображение</label>
                            <input type="file" name="image">
                        </div>
                        <button type="submit" class="btn btn-ultraviolet-rays-1">Сохранить</button>
                    </form>

                </div>
                <!-- END CONTENT -->
            </div>
        </div>
    </div>
    <!-- END PRIMARY -->
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: 'textarea.tinymce-editor',
            height: 100,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            content_css: '//www.tiny.cloud/css/codepen.min.css'
        });
    </script>
@endsection




