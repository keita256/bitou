@extends('layouts.common')

@section('title', '月初の入力')
@include('layouts.head')

@include('layouts.header')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="offset-3 col-6 monthlyInput-div">
            <h3>月初入力</h3>

            <div class="row">
                <div class="offset-2 col-8 inner-div rounded">
                    <form action="">
                        <div class="form-group">
                            <label for="">収入</label>
                            <input class="form-control" type="text">
                            <small class="text-muted">今月の収入を入力してください。</small>
                        </div>

                        <div class="form-group">
                            <label for="">目標支出</label>
                            <input class="form-control" type="text">
                            <small class="text-muted">今月の目標支出を入力してください。</small>
                        </div>

                        <button type="submit" class="btn btn-primary float-right">送信する</button>
                    </form>
                </div>
            </div>
        </div><!-- col -->
    </div><!-- row -->
</div><!-- container -->
@endsection