@extends('layouts.common')

@section('title', 'ログイン')
@include('layouts.head')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-10 offset-1 col-lg-4 offset-lg-4 mt-5">
            <img src="images/pigLogo.png" class="img-fluid mx-auto d-block mb-3" alt="MonelyzePig" style="filter: drop-shadow(10px 10px 10px rgba(112, 101, 101, 0.4));">

            <form action="{{ url('/login') }}" method="POST">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="control-label text-center">メールアドレス</label>

                    <div class="justify-content-center">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password">パスワード</label>

                    <div class="justify-content-center">
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
                    <div class="justify-content-center">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> 記憶する
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="justify-content-center">
                        <a class="btn btn-link" href="{{ url('/register') }}">
                            アカウントを作成
                        </a>

                        <button type="submit" class="btn btn-primary float-right button hvr-shadow">
                            ログイン
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div><!-- row -->
</div><!-- container -->
@endsection
