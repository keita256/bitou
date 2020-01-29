@extends('layouts.common')

@section('title', '固定費を入力')
@include('layouts.head')
@include('layouts.header')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="offset-1 col-10 offset-lg-1 col-lg-7 main-content">
            <div class="title title0 ">
                <h3 class="heading">{{ $display_date }}の固定費一覧</h3>
            </div>
            <div class="table-responsive">
                @if($payments != null)
                <table class="table table-sm table-bordered table-striped table-hover">

                    <thead class="thead-light">
                        <tr>
                            <th scope="col" class="align-middle text-nowrap text-center">内容</th>
                            <th scope="col" class="align-middle text-nowrap text-center">金額</th>
                        </tr>
                    </thead>

                    <!-- 固定費一覧データ -->

                    <tbody data-placement="right">
                        @foreach($payments as $payment)
                        <tr data-toggle="modal" data-target="#staticBackdrop">
                            <td class="align-middle">{{ $payment->content }}</td>
                            <td class="align-middle text-right text-nowrap">{{ $payment->amount }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <h2>当該月の入力データはありません。</h2>
                @endif
            </div>


            <div class="row">
                <div class="col-12 payment-div">
                    <h3>固定費入力</h3>

                    <div class="row">
                        <div class="offset-1 col-10 inner-div rounded">
                            <form class="" action="/payment" method="post" accept-charset="UTF-8">
                                @csrf
                                <div class="form-row">
                                    <input class="form-sm6" name="payments[content][]" type="text" autocomplete="off" required placeholder="内容">
                                    <input class="form-sm6 keyword" name="payments[amount][]" id="item_amount" type="text" autocomplete="off" required placeholder="金額">
                                    <input type="button" class="form-sm6" value="×" onClick="form_remove(this);">
                                </div>

                                <div id="fixed">
                                    <input type="button" value="フォームの追加" class="add pluralBtn">
                                </div>

                                <button type="submit" class="btn btn-primary float-right">送信する</button>
                            </form>
                        </div>
                    </div>
                </div><!-- col -->
            </div><!-- row -->

            <div class="col-lg-3">
                <div class="row">
                    <div class="offset-1 col-10 offset-lg-1 col-lg-11 sidebar-content">

                    </div><!-- 入れ子col -->
                </div><!-- 入れ子row -->
            </div><!-- col -->

        </div><!-- row -->
    </div><!-- container -->

    <!-- モーダルの設定 -->


    <!--フォーム増加用-->
    <div class="form-row" id="template" style="display:none">
        <input class="form-sm6" name="payments[content][]" type="text" autocomplete="off" required placeholder="内容">
        <input class="form-sm6 keyword" name="payments[amount][]" id="item_amount" type="text" autocomplete="off" required placeholder="金額">
        <input type="button" class="form-sm6" value="×" onClick="form_remove(this);">
    </div>
    <script src="{{ asset('js/spend.js') }}"></script>
    @endsection