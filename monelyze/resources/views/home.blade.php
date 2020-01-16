@extends('layouts.common')

@section('title', 'ホーム')
@include('layouts.head')

@include('layouts.header')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-10 rounded-lg"
                style="background-color: rgb(255, 255, 255); filter: drop-shadow(10px 10px 10px rgba(112, 101, 101, 0.4));">
                <div class="row justify-content-md-center">
                    <div class="col-md-8">
                        <h3>12月</h3>

                        <div class="table-responsive">
                            <table class="table table-sm table-bordered table-striped table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col" class="text-nowrap">日付</th>
                                        <th scope="col" class="text-nowrap">費目</th>
                                        <th scope="col" class="text-nowrap">内容</th>
                                        <th scope="col" class="text-nowrap">金額</th>
                                    </tr>
                                </thead>

                                <!-- 家計簿データ -->

                                <tbody data-placement="right">
                                    @foreach($spends as $spend)
                                    <tr data-toggle="modal" data-target="#staticBackdrop">
                                        <td>{{ $spend->date }}</td>
                                        <td>{{ $spend->name }}</td>
                                        <td>{{ $spend->content }}</td>
                                        <td>{{ $spend->amount }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>

                    <div class="col-md-3">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td><b>合計</b></td>
                                    <td>???円</td>
                                </tr>

                                <tr>
                                    <td><b>平均</b></td>
                                    <td>???円</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- モーダルの設定 -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
    
@endsection