@extends('layouts.common')

@section('title', 'パスワードをリセット')
@include('layouts.head')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-10 offset-1 col-lg-6 offset-lg-3 mt-5">
            <div class="panel panel-default">
                <div class="panel-heading"><h1 class="responsive-font-size">パスワードをリセット</h1></div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label">現在のメールアドレス</label>

                            <div>
                                <input id="email" type="email" class="form-control" name="email" value="" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>このパスワードリセットトークンは無効です。</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label">パスワード</label>

                            <div>
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="control-label">新しいパスワード</label>
                            <div>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            
                            <button type="submit" class="float-right btn btn-primary">
                                変更
                            </button>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
