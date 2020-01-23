@extends('layouts.common')

@section('title', 'ホーム')
@include('layouts.head')

@include('layouts.header')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="offset-3 col-6">
            <h3>{{ $display_date }}</h3>

            <hr>

            <div class="table-responsive">
                @if($spends != null)
                <table class="table table-sm table-bordered table-striped table-hover">

                    <thead class="thead-light">
                        <tr>
                            <th scope="col" class="text-nowrap text-center">費目</th>
                            <th scope="col" class="text-nowrap text-center">内容</th>
                            <th scope="col" class="text-nowrap text-center">金額</th>
                        </tr>
                    </thead>

                    <!-- 家計簿データ -->

                    <tbody data-placement="right">
                        @foreach($spends as $spend)
                        <tr data-toggle="modal" data-target="#staticBackdrop">
                            <td class="text-center">{{ $spend->name }}</td>
                            <td class="text-right">{{ $spend->content }}</td>
                            <td class="text-right">{{ $spend->amount }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <h2>本日の入力データはありません。</h2>
                @endif
            </div>

            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-6 offset-3">
            <h2>{{ $year }}年{{ $month }}月の費目ごとの消費額</h2>

            <div class="table-responsive">
                <table class="table">
                    @foreach($monthly_consumptions as $data)
                    <tr>
                        <th>{{ $data->name }}</th>
                        <td>{{ $data->total }}円</td>
                    </tr>
                    @endforeach
                </table>
            </div>

        </div>
    </div>

</div>

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
@endsection
