@extends('layouts.common')

@section('title', '家計簿を入力')
@include('layouts.head')
@include('layouts.header')

@section('content')
<div class="container">

    @if (Session::has('message'))
    <p>{{ session('message') }}</p>
    @endif

    @if ($errors->any())
    <div class="errors">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="/spend" method="post" accept-charset="UTF-8">
        @csrf
        <div class="row">
            <h1>家計簿入力画面</h1>
        </div>
        <div class="row text-left">
            <div class="col-4">費目名</div>
            <div class="col-4">内容</div>
            <div class="col-4">金額</div>
        </div>

        <div class="row" style="display:inline-flex">
            <div class="col-4">
                <select id="name_list">
                    @foreach($expenses as $expense)
                    <option name="spend_id" value="{{ $expense->expense_id }}">{{ $expense->name }}</option>
                        @endforeach
                </select>
            </div>
            <div class="col-4">
                <input type="text" name="spend_content" id="items_content">
            </div>
            <div class="col-4">
                <input type="text" name="spend_amount" id="items_amount">
            </div>
            <input type="button" value="＋" class="add pluralBtn">
            <input type="button" value="－" class="del pluralBtn">
        </div>

        <div class="row">
            <div class="total-amount">
                <label>合計金額</label>
                <div class="col-9">
                    <div class="val"></div>
                    ￥
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                        <input type="text" name="spend_date" class="form-control datetimepicker-input" data-target="#datetimepicker4" />
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
        <div class="row">
            <button type="submit">入力</button>
        </div>
    </form>
</div>


<script src="monelyze\resources\views\js\spend.js">
    @endsection