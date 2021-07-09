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
                            <h1>Добавить социальную сеть</h1>
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
                    <form action="{{route('social_network_save_new')}}" method="post">
                        @csrf
                            <div class="form-group">
                                <label style="color: gold" >Название</label>
                                <input type="text" name="name" class="form-control" placeholder="Введите название социальной сети">
                            </div>
                            <div class="form-group col-md-9">
                                <label style="color: gold">Ссылка</label>
                                <input type="text" name="link" class="form-control" placeholder="Введите ссылку на социальную сеть">
                            </div>
                        <button type="submit" class="btn btn-ultraviolet-rays-1">Редактировать</button>
                    </form>

                </div>
                <!-- END CONTENT -->
            </div>
        </div>
    </div>
    <!-- END PRIMARY -->
@endsection


