@extends('layouts.common')

@section('title', 'ログイン')
@include('layouts.head')

@section('content')
<div class="container-fluid ">
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <h1 class="text-center">Monelyze</h1>

            <form action="{{ url('/login') }}" method="POST">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-6 offset-3 control-label">メールアドレス</label>

                    <div class="col-6 offset-3">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-6 offset-3 control-label">パスワード</label>

                    <div class="col-6 offset-3">
                        <input id="password" type="password" class="form-control" name="password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif

                        <a class="btn btn-link" href="{{ url('/password/reset') }}">
                            パスワードを忘れた場合
                        </a>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-6 offset-3">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> 記憶する
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-6 offset-3">
                        <a class="btn btn-link" href="{{ url('/register') }}">
                            アカウントを作成
                        </a>

                        <button type="submit" class="btn btn-primary float-right">
                            ログイン
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
