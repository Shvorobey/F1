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
                            <img src="/images/my/partners.png" alt="title"/>
                        </div>
                        <div class="title-with-icon">
                            <h1>Добавить партнера</h1>
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
                    <form action="{{route('partner_save_new')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label style="color: gold" >Название</label>
                            <input class="span12" type="text" name="name"  placeholder="Введите наименование партнера" value="{{old('name')}}">
                        </div>
                        <div class="form-group">
                            <label style="color: gold" >Ссылка</label>
                            <input class="span12" type="text" name="link"  placeholder="Введите ссылку на ресурс партнера" value="{{old('link')}}">
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
@endsection




