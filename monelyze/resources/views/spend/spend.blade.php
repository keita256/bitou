@extends('layouts.common')

@section('title', '家計簿を入力')
@include('layouts.head')
@include('layouts.header')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="offset-lg-2 col-lg-8 offset-md-2 col-md-8 offset-sm-1 col-sm-10 monthlyInput-div">
            <h3>家計簿入力</h3>

            <div class="row animated tdShrinkIn">
                <div class="offset-1 col-10 offset-md-1 col-md-10 offset-sm-1 col-sm-10  inner-div rounded">
                    @if (Session::has('message'))
                    <p>{{ session('message') }}</p>
                    @endif

                    <form action="/spend" method="post">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <select class="form-control" name="spends[expense_id][]" id="name_list" accept-charset="UTF-8">
                                <option value="">費目名を選択してください</option>
                                @foreach($expenses as $expense)
                                <option name="spends[expense_id][]" value="{{ $expense->expense_id }}">
                                    {{ $expense->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="内容" name="spends[content][]" id="items_content" autocomplete="off" value="">
                        </div>

                        <div class="form-group">
                            <input class="form-control" type="number" min="1" required placeholder="金額" name="spends[amount][]" class="keyword" id="items_amount" autocomplete="off" value="">
                        </div>
                        <div id="fixed">
                            <hr>
                            <input type="button" value="フォームの追加" class="add pluralBtn btn btn-outline-primary btn-sm float-left" style="margin-bottom:1em;">
                        </div>

                        <div class="form-group">
                            <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                                <input type="text" required name="spend_date" placeholder="日付を選択" class="form-control datetimepicker-input" data-target="#datetimepicker4" autocomplete="off">
                                <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar"></i>
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

                        <button type="submit" class="btn btn-primary float-right">送信する</button>
                    </form>
                </div>
            </div>
        </div><!-- col -->
    </div><!-- row -->
</div><!-- container -->

<div id="template" style="display:none" class="animated tdDropInLeft">
    <hr>
    <div class="form-group">
        <select class="form-control" name="spends[expense_id][]" id="name_list">
            <option selected disabled>費目名を選択してください。</option>
            @foreach($expenses as $expense)
            <option name="spends[expense_id][]" value="{{ $expense->expense_id }}">{{ $expense->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <input class="form-control" type="text" placeholder="内容" name="spends[content][]" id="items_content" autocomplete="off" value="">
    </div>

    <div class="form-group">
        <input class="form-control" type="number" min="1" required placeholder="金額" name="spends[amount][]" class="keyword" id="items_amount" autocomplete="off" value="">
    </div>
    <div class="form-group clearfix">
        <input type="button" class="cross_mark button btn btn-outline-primary btn-sm float-right" value="項目削除" onClick="form_remove(this); ">
    </div>
</div>


<script src="{{ asset('js/form.js') }}"></script>
@endsection
