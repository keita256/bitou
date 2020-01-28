@extends('layouts.common')

@section('title', '月初の入力')
@include('layouts.head')

@include('layouts.header')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col content-div-last">
            <div class="row">
                <div class="offset-3 col-6">
                    <form action="">
                        <div class="form-group">
                            <label for="">手取り収入</label>
                        </div>

                        <div class="form-group">
                            <label for="">目標支出</label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection