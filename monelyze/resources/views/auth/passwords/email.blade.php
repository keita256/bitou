@extends('layouts.common')

@section('title', 'パスワードをリセット')
@include('layouts.head')
<!-- Main Content -->
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-10 offset-1 col-lg-4 offset-lg-4 mt-5">
            <div class="mb-3">
                <h1 style="text-align: center;">パスワードをリセット</h1>
            </div>
            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif

            <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="control-label">メールアドレス</label>

                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group">
                    <a class="btn btn-link" href="{{ url('/login') }}">
                        ログイン画面に戻る
                    </a>
                    <button type="submit" class="btn btn-primary float-right">
                        パスワードをリセット
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection