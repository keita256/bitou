@extends('layouts.common')

@section('title', 'ユーザー登録')
@include('layouts.head')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="justify-content-center col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-sm-10 offset-sm-1">

            <div class="col-10 offset-1 mt-5" style="text-align: center;">
                <h1>新規登録</h1>
            </div>

            <form class="col-lg-8 offset-lg-2 col-sm-10 offset-sm-1" role="form" method="POST" action="{{ url('/register') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="control-label">ユーザー名</label>

                    <div class="">
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                        @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="control-label">メールアドレス</label>


                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif

                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="control-label">パスワード</label>

                    <input id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif

                </div>

                <div class="form-group">
                    <label for="password-confirm" class="control-label">パスワード（確認）</label>

                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>

                <div class="form-group">
                    <a class="btn btn-link" href="{{ url('/login') }}">
                        ログイン画面に戻る
                    </a>
                    <button type="submit" class="btn btn-primary float-right">
                        登録
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection