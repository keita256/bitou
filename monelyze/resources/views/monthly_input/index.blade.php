@extends('layouts.common')

@section('title', '月初入力')
@include('layouts.head')

@include('layouts.header')

@section('content')



<div class="container-fluid">
    <div class="row">
        <div class="offset-md-3 col-md-6 offset-sm-1 col-sm-10 monthlyInput-div">
            <h3>月初入力</h3>

            <div class="row">
                <div class="offset-md-2 col-md-8 offset-sm-1 col-sm-10 inner-div rounded">
                    <h2>{{ $year }}年{{ $month }}月</h2>

                    @if (Session::has('message'))
                    <p>⚠{{ session('message') }}</p>
                    @endif
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="/monthlyInput/{{ $year }}/{{ $month }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label for="">収入</label>
                            <input class="form-control" type="text" name="take_amount">
                            <small class="text-muted">今月の収入を入力してください。</small>
                        </div>

                        <div class="form-group">
                            <label for="">目標支出</label>
                            <input class="form-control" type="text" name="target_spending">
                            <small class="text-muted">目標支出: 今月の消費できる金額の上限</small>
                        </div>

                        <button type="submit" class="btn btn-primary float-right">送信する</button>
                    </form>
                </div>
            </div>
        </div><!-- col -->
    </div><!-- row -->
</div><!-- container -->
@endsection