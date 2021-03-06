@extends('layouts.common')

@section('title', 'ユーザー設定')
@include('layouts.head')

@include('layouts.header')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="offset-md-3 col-md-6 offset-sm-1 col-sm-10 monthlyInput-div">
            <h3>ユーザー名の変更</h3>

            @if (Session::has('message'))
            <p>{{ session('message') }}</p>
            @endif

            <div class="row">
                <div class="offset-1 col-10 offset-md-1 col-md-10 offset-sm-1 col-sm-10 inner-div rounded">
                    <form action="/users/nameSetting" method="post" accept-charset="UTF-8">
                        @csrf
                        <div class="form-group">
                            <label for="name">新しいユーザー名</label>
                            <input class="form-control" id="name" name="userName" required type="text" autocomplete="off">
                        </div>

                        <button type="submit" class="btn btn-primary float-right">保存</button>
                    </form>
                </div>
            </div>
        </div><!-- col -->
    </div><!-- row -->
</div><!-- container -->
@endsection