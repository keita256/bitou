@extends('layouts.common')

@section('title', 'ユーザー設定')
@include('layouts.head')

@include('layouts.header')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="offset-md-3 col-md-6 offset-sm-1 col-sm-10 monthlyInput-div">
            <h3>ユーザー設定</h3>

            @if (Session::has('message'))
            <p>{{ session('message') }}</p>
            @endif

            <div class="row">
                <div class="offset-md-2 col-md-8 offset-sm-1 col-sm-10 inner-div rounded">
                        <div class="">
                            <label class="float-left">現在のユーザー名：</label>
                            <label>{{$username}}</label>
                            <a class="btn btn-link" href="/users/nameSetting">
                                変更
                            </a>
                        </div>

                        <div class="clearfix">
                            <label class="float-left">現在のメールアドレス：</label>
                            <label>{{$mail}}</label>
                            <a class="btn btn-link" href="/users/mailSetting">
                                変更
                            </a>
                        </div>
                </div>
            </div>
        </div><!-- col -->
    </div><!-- row -->
</div><!-- container -->
@endsection