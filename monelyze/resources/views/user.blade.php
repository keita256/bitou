@extends('layouts.common')

@section('title', 'ユーザー設定')
@include('layouts.head')

@include('layouts.header')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="offset-3 col-6 monthlyInput-div">
            <h3>ユーザー設定</h3>

            @if (Session::has('message'))
            <p>{{ session('message') }}</p>
            @endif

            <div class="row">
                <div class="offset-2 col-8 inner-div rounded">
                    <form action="/user/edit" method="post" accept-charset="UTF-8">
                        <div class="form-group">
                            <label for="">ユーザー名</label>
                            <input class="form-control" type="text" value="">
                        </div>

                        <div class="form-group">
                            <label for="">新しいメールアドレス</label>
                            <input class="form-control" type="text" value="">
                        </div>

                        <button type="submit" class="btn btn-primary float-right">送信する</button>
                    </form>
                </div>
            </div>
        </div><!-- col -->
    </div><!-- row -->
</div><!-- container -->
@endsection