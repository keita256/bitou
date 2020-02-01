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
                <div class="offset-md-2 col-md-8 offset-sm-1 col-sm-10 inner-div rounded">
                    <form action="/users/mailSetting" method="post" accept-charset="UTF-8">
                    @csrf
                        <div class="form-group">
                            <label for="mail">新しいメールアドレス</label>
                            <input class="form-control" id="mail" required type="email" value="">
                        </div>

                        <button type="submit" class="btn btn-primary float-right">保存</button>
                    </form>
                </div>
            </div>
        </div><!-- col -->
    </div><!-- row -->
</div><!-- container -->
@endsection
