
@extends('Layouts.layout')

@section('title', 'F1 | Odessa')

@section('content')

<!-- END HEADER -->
<div id="page-meta" class="group">
    <div class="container">
        <div class="row">
            <div class="span12">
                <!-- TITLE -->
                <div class="title">
                    <div class="icontitle">
                        <img src="/images/my/login.png" alt="title"/>
                    </div>
                    <div class="title-with-icon">
                        <h1>Вход</h1>
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
            <div id="content-page" class="span12 content group">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row">
                            <label style="color: gold" for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color: red">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label style="color: gold" for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color: red">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <b style="color: gold">{{ __('Remember Me') }}</b>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-warning">
                                    {{ __('Login') }}
                                </button>
                                @if (Route::has('password.request'))
                                    <hr><a class="btn btn-light" href="{{ route('password.request') }}">
                                        {{ __('Забыли пароль?') }}
                                    </a>
                                @endif
                                @if (Route::has('register'))
                                        <a class="btn btn-dark" href="{{ route('register') }}">{{ __('Зарегестрироваться') }}</a>
                                @endif
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection
