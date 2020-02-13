@extends('layouts.common')

@section('title', 'ユーザー設定')
@include('layouts.head')

@include('layouts.header')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="offset-md-3 col-md-6 offset-sm-1 col-sm-10 monthlyInput-div">
            <h3>メールアドレスの変更</h3>

            @if (Session::has('message'))
            <p>{{ session('message') }}</p>
            @endif

            <div class="row">
                <div class="offset-1 col-10 offset-md-1 col-md-10 offset-sm-1 col-sm-10 inner-div rounded">
                    <form action="/users/mailSetting" method="post" accept-charset="UTF-8">
                    @csrf
                        <div class="form-group">
                            <label for="mail">新しいメールアドレス</label>
                            <input class="form-control" id="mail" name="userMail" required type="email" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label for="remail">メールアドレスの再入力</label>
                            <input class="form-control" id="remail" name="userReMail" required type="email" autocomplete="off">
                        </div>

                        <button type="submit" class="btn btn-primary float-right">保存</button>
                    </form>
                </div>
            </div>
        </div><!-- col -->
    </div><!-- row -->
</div><!-- container -->
@endsection
