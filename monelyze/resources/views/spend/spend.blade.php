@extends('layouts.common')

@section('title', '家計簿を入力')
@include('layouts.head')
@include('layouts.header')

@section('content')
<div class="container input">
    <div class="row">
        <h1>家計簿入力画面</h1>
    </div>

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
    <form action="/spend" method="post" accept-charset="UTF-8">
        @csrf
        <div class="row text-left">
            <div class="col-4">費目名</div>
        </div>

        <div class="row" style="display:inline-flex">
            <div class="col-4">
                <select name="spends[expense_id][]" id="name_list">
                    @foreach($expenses as $expense)
                    <option name="spends[expense_id][]" value="{{ $expense->expense_id }}">{{ $expense->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-4">
                <input type="text" required placeholder="内容" name="spends[content][]" id="items_content" autocomplete="off" value="">
            </div>
            <div class="col-4">
                <input type="number" min="1" required placeholder="金額" name="spends[amount][]" class="keyword" id="items_amount" autocomplete="off" value="">
            </div>
            <input type="button" class="cross_mark button btn btn-outline-primary btn-sm" value="項目削除" onClick="form_remove(this);">
        </div>

        <div id="fixed">
            <input type="button" value="フォームの追加" class="add pluralBtn btn btn-outline-primary btn-sm">
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                        <input type="text" name="spend_date" class="form-control datetimepicker-input" data-target="#datetimepicker4" autocomplete="off" />
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
            <button type="submit" class="btn btn-outline-primary">入力</button> </div>
    </form>

    <!--フォーム増加用-->
    <div class="row" id="template" style="display:none">
        <div class="col-4">
            <select name="spends[expense_id][]" id="name_list">
                @foreach($expenses as $expense)
                <option name="spends[expense_id][]" value="{{ $expense->expense_id }}">{{ $expense->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-4">
            <input type="text" required placeholder="内容" 　name="spends[content][]" id="items_content" autocomplete="off" value="">
        </div>
        <div class="col-4">
            <input type="number" min="1" required placeholder="金額" 　name="spends[amount][]" class="keyword" id="items_amount" autocomplete="off" value="">
        </div>
        <input type="button" class="cross_mark btn btn-outline-primary btn-sm" value="項目削除" onClick="form_remove(this);">
    </div>

</div>

<script src="{{ asset('js/spend.js') }}"></script>
@endsection
