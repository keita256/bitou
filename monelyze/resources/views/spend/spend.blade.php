@extends('layouts.common')

@section('title', '家計簿を入力')
@include('layouts.head')
@include('layouts.header')

@section('content')
<!--
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
-->

<div class="container-fluid">
    <div class="row">
        <div class="offset-3 col-6 monthlyInput-div">
            <h3>家計簿入力</h3>

            <div class="row">
                <div class="offset-2 col-8 inner-div rounded">
                    <form action="">
                        <div class="form-group">
                            <select class="form-controll" name="spends[expense_id][]" id="name_list">
                                <option selected disabled>費目名を選択してください。</option>
                                @foreach($expenses as $expense)
                                <option name="spends[expense_id][]" value="{{ $expense->expense_id }}">{{ $expense->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <input class="form-controll" type="text" placeholder="内容" name="spends[content][]" id="items_content" autocomplete="off" value="">
                        </div>

                        <div class="form-group">
                            <input class="form-controll" type="number" min="1" required placeholder="金額" name="spends[amount][]" class="keyword" id="items_amount" autocomplete="off" value="">
                        </div>
                        <div id="fixed">
                            <hr>
                            <input type="button" value="フォームの追加" class="add pluralBtn btn btn-outline-primary btn-sm float-left">
                        </div>

                        <button type="submit" class="btn btn-primary float-right">送信する</button>
                    </form>
                </div>
            </div>
        </div><!-- col -->
    </div><!-- row -->
</div><!-- container -->

<div id="template" style="display:none">
    <hr>
    <div class="form-group">
        <select class="form-controll" name="spends[expense_id][]" id="name_list">
            <option selected disabled>費目名を選択してください。</option>
            @foreach($expenses as $expense)
            <option name="spends[expense_id][]" value="{{ $expense->expense_id }}">{{ $expense->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <input class="form-controll" type="text" placeholder="内容" name="spends[content][]" id="items_content" autocomplete="off" value="">
    </div>

    <div class="form-group">
        <input class="form-controll" type="number" min="1" required placeholder="金額" name="spends[amount][]" class="keyword" id="items_amount" autocomplete="off" value="">
    </div>
    <div class="form-group clearfix">
        <input type="button" class="cross_mark button btn btn-outline-primary btn-sm float-right" value="項目削除" onClick="form_remove(this);">
    </div>
</div>


<script src="{{ asset('js/form.js') }}"></script>
@endsection