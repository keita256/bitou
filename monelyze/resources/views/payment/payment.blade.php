@extends('layouts.common')

@section('title', '固定費を入力')
@include('layouts.head')
@include('layouts.header')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="offset-1 col-10 offset-lg-1 col-lg-7 main-content">
            <div class="title title0 ">
                <h3 class="heading">固定費一覧</h3>
            </div>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if (Session::has('message'))
            <p>{{ session('message') }}</p>
            @endif
            <section class="">
                <h3 class="">{{ $year }}年{{ $month }}月</h3>
            </section>
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
                            <td class="align-middle text-center">{{ $payment->content }}</td>
                            <td class="align-middle text-center text-nowrap">{{ $payment->amount }}</td>
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

        </div><!-- row -->

        <div class="col-lg-3">
            <div class="row">
                <div class="offset-1 col-10 offset-lg-1 col-lg-11 sidebar-content">
                    <div class="row">

                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="title title0">
                                <h3 class="heading">{{ $year }}年の固定費一覧</h3>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-Light table-hover table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>月</th>
                                            <th>合計金額(円)</th>
                                        </tr>
                                    </thead>
                                    @for ($i = 0; $i < 12; $i++) <tr data-href="/payment/{{ $year }}{{ $monthArray[$i] }}">
                                        <td>{{ $i + 1 }}</td>
                                        <!-- 改修必要 -->
                                        <td></td>
                                        </tr>
                                        @endfor
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- 入れ子col -->
            </div><!-- 入れ子row -->
        </div><!-- col -->
    </div><!-- container -->

    <!-- モーダルの設定 -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">編集</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="exampleSelect1exampleFormControlSelect1">費目の選択</label>
                            <select class="form-control" id="exampleFormControlSelect1">
                                <option>食費</option>
                                <option>生活費</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="Input1">内容</label>
                            <input type="text" class="form-control" id="Input1" placeholder="内容を記入">
                        </div>

                        <div class="form-group">
                            <label for="Input2">金額</label>
                            <input type="text" class="form-control" id="Input2" placeholder="金額を記入">
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">変更を確定</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                </div>
            </div>
        </div>
    </div>

    <!--フォーム増加用-->
    <div class="form-row" id="template" style="display:none">
        <input class="form-sm6" name="payments[content][]" type="text" autocomplete="off" required placeholder="内容">
        <input class="form-sm6 keyword" name="payments[amount][]" id="item_amount" type="text" autocomplete="off" required placeholder="金額">
        <input type="button" class="form-sm6" value="×" onClick="form_remove(this);">
    </div>
    <script src="{{ asset('js/form.js') }}"></script>
    <script src="{{ asset('js/index.js') }}"></script>
    @endsection