@extends('layouts.common')

@section('title', '家計簿を入力')
@include('layouts.head')

@include('layouts.header')

@section('content')
<h1>家計簿入力画面</h1>

@foreach($expenses as $expense)
<p>{{ $expense->name }}</p>
@endforeach

<div class="spend">
    <div class="row">
        <div class="col-3">費目名</div>
        <div class="col-3">内容</div>
        <div class="col-3">金額</div>
    </div>
    <div class="row-item">
        <div class="col-3">
            <input type="text" id="items_name">
        </div>
        <div class="col-3">
            <input type="text" id="items_content">
        </div>
        <div class="col-3">
            <input type="text" id="items_amount">
        </div>
    </div>
    <div class="row-item">
        <div class="col-3">
            <input type="text" id="items_name">
        </div>
        <div class="col-3">
            <input type="text" id="items_content">
        </div>
        <div class="col-3">
            <input type="text" id="items_amount">
        </div>
    </div>
    <div class="row-item">
        <div class="col-3">
            <input type="text" id="items_name">
        </div>
        <div class="col-3">
            <input type="text" id="items_content">
        </div>
        <div class="col-3">
            <input type="text" id="items_amount">
        </div>
    </div>
</div>

<div class="total-amount">
    <label>合計金額</label>
    <div class="col-9">
        <div class="val"></div>
        ￥
    </div>
</div>


<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker4" />
                <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function() {
            $('#datetimepicker4').datetimepicker({
                format: 'L'
            });
        });
    </script>
</div>

<button type="submit">入力</button>
@endsection;