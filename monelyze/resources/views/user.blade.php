@extends('layouts.common')

@section('title', 'ユーザー設定')
@include('layouts.head')

@include('layouts.header')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="offset-lg-2 col-lg-8 offset-md-2 col-md-8 offset-sm-1 col-sm-10 monthlyInput-div">
            <h3>ユーザー設定</h3>

            @if (Session::has('message'))
            <p>{{ session('message') }}</p>
            @endif

            <div class="row ">
                <div class="offset-1 col-10 offset-md-1 col-md-10 offset-sm-1 col-sm-10 inner-div rounded">
                    <div class="mb-3 clearfix">
                        <label class="float-left mt-1 mb-4">現在のユーザー名：{{$username}}</label>
                        <a href="/users/nameSetting"><button class="btn btn-primary float-right  mb-3 ">変更</button></a>
                    </div>

                    <div class="mb-3">
                        <label class="float-left mt-2 mb-1">現在のメールアドレス：{{$mail}}</label>
                        <a href="/users/mailSetting"><button class="btn btn-primary float-right mb-1">変更</button></a>
                    </div>
                </div>
            </div>
        </div><!-- col -->
    </div><!-- row -->
</div><!-- container -->
@endsection
