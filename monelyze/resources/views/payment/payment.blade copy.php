@extends('layouts.common')

@section('title', '固定費を入力')
@include('layouts.head')
@include('layouts.header')

@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="container-fluid">
    <div class="row">
        <div class="offset-3 col-6 monthlyInput-div">
            <h3>固定費入力</h3>

            @if (Session::has('message'))
            <p>{{ session('message') }}</p>
            @endif


            <div class="row">
                <div class="offset-2 col-8 inner-div rounded">
                    <form class="" action="/payment" method="post" accept-charset="UTF-8">
                        @csrf
                        <div>
                            <div>内容</div>
                            <div>金額</div>
                        </div>

                        <div class="form-row">
                            <input class="form-sm6" name="payments[content][]" type="text" autocomplete="off">
                            <input class="form-sm6 keyword" name="payments[amount][]" id="item_amount" type="text" autocomplete="off">
                            <input type="button" class="form-sm6" value="×" onClick="form_remove(this);">
                        </div>

                        <div id="fixed">
                            <input type="button" value="フォームの追加" class="add pluralBtn">
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                                    <input type="text" name="payment_date" class="form-control datetimepicker-input" data-target="#datetimepicker4" autocomplete="off" />
                                    <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script type="text/javascript">
                            $(function() {
                                $('#datetimepicker4').datetimepicker({
                                    format: 'YYYY/MM'
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

<!--フォーム増加用-->
<div class="form-row" id="template" style="display:none">
    <input class="form-sm6" name="payments[content][]" type="text" autocomplete="off">
    <input class="form-sm6 keyword" name="payments[amount][]" id="item_amount" type="text" autocomplete="off">
    <input type="button" class="form-sm6" value="×" onClick="form_remove(this);">
</div>
<script src="{{ asset('js/form.js') }}"></script>
@endsection