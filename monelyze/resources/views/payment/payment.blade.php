@extends('layouts.common')

@section('title', '固定費を入力')
@include('layouts.head')
@include('layouts.header')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="offset-1 col-10 offset-lg-1 col-lg-7 main-content">
            <h3 class="responsive-font-size">{{ $year }}年{{ $month }}月 固定費一覧<button class="btn btn-primary float-right" data-toggle="modal" data-target="#dateChange">年月変更</button></h3>

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
                        <tr data-toggle="modal" data-target="#staticBackdrop" class="insertVal">
                            <td class="align-middle text-center table-optimisation">{{ $payment->content }}</td>
                            <td class="align-middle text-center text-nowrap table-optimisation">{{ $payment->amount }}</td>
                            <td style="display:none">{{ $payment->number}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <h2 class="responsive-font-size">固定費一覧より該当月を選択すると、ここに詳細が表示されます。</h2>
                @endif
            </div>


            <div class="row">
                <div class="col-12 payment-div">
                    <h3 class="responsive-font-size">固定費入力</h3>

                    <div class="row">
                        <div class="offset-1 col-10 inner-div rounded">
                            <form class="" action="/payment/insert/{{ $year }}/{{ $month }}" method="post" accept-charset="UTF-8">
                                @csrf
                                <div class="form-group">
                                    <input class="form-controll" name="payments[content][]" type="text" autocomplete="off" required placeholder="内容">
                                </div>

                                <div class="form-group">
                                    <input class="form-controll keyword" name="payments[amount][]" id="item_amount" type="number" autocomplete="off" required placeholder="金額">
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

        </div><!-- row -->

        <div class="col-lg-3">
            <div class="row">
                <div class="offset-1 col-10 offset-lg-1 col-lg-11 sidebar-content">
                    <div class="row">

                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="title title0">
                                <h4 class="heading responsive-font-size">{{ $year }}年の固定費一覧</h4>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-Light table-hover table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-center">月</th>
                                            <th class="text-center">合計金額</th>
                                        </tr>
                                    </thead>
                                    @for ($i = 0; $i < 12; $i++) <tr data-href="/payment/{{ $year }}/{{ $i + 1 }}">
                                        <td class="text-center table-optimisation">{{ $i + 1 }}</td>
                                        <td class="text-center table-optimisation">{{ $totalAmount[$i] }}円</td>
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
                    <form action="/payment" method="post" class="changeAction" accept-charset="UTF-8">
                        @csrf
                        <div class="form-group">
                            <label for="Input1">内容</label>
                            <input type="text" class="form-control" id="Input1" name="content" placeholder="内容を記入" required value="">
                        </div>

                        <div class="form-group">
                            <label for="Input2">金額</label>
                            <input type="number" class="form-control" id="Input2" name="amount" placeholder="金額を記入" required value="">
                        </div>

                        <input type="hidden" name="number" id="Input3" value="">

                        <div class="pull-left">
                            <button class="btn btn-primary btn-sm" onclick="setAction('/payment/delete/{{ $year }}/{{ $month }}')">削除する</button>
                        </div>
                        <button class="btn btn-primary pull-right" onclick="setAction('/payment/edit/{{ $year }}/{{ $month }}')">変更を確定</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="dateChange" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">日付変更</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="/payment" method="get" class="form-inline justify-content-between dateForm" accept-charset="UTF-8">
                        @csrf
                        <div class="form-row">
                            <select class="form-controlle" id="selectYear">
                                @for ($i = $year - 3; $i <= $year + 3; $i++) @if ($year==$i) <option value="{{ $i }}" selected>{{ $i }}</option>
                                    @continue
                                    @endif
                                    <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                            </select>
                            <div>年</div>
                        </div>

                        <div class="form-group">
                            <select class="form-controlle" id="selectMonth">
                                @for ($i = 1; $i <= 12; $i++) @if ($month==$i) <option value="{{ $i }}" selected>{{ $i }}</option>
                                    @continue
                                    @endif
                                    <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                            </select>
                            <div>月</div>
                        </div>

                        <button class="btn btn-primary pull-right dateChange">表示</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--フォーム増加用-->
    <div id="template" style="display:none">
        <hr>
        <div class="form-group">
            <input class="form-controll" name="payments[content][]" type="text" autocomplete="off" required placeholder="内容">
        </div>

        <div class="form-group">
            <input class="form-controll keyword" name="payments[amount][]" id="item_amount" type="number" autocomplete="off" required placeholder="金額">
        </div>
        <div class="form-group clearfix">
            <input type="button" class="cross_mark button btn btn-outline-primary btn-sm float-right" value="項目削除" onClick="form_remove(this);">
        </div>
    </div>

    <script src="{{ asset('js/form.js') }}"></script>
    <script src="{{ asset('js/index.js') }}"></script>
    @endsection
