@extends('layouts.common')

@section('title', 'ホーム')
@include('layouts.head')

@include('layouts.header')

@section('content')
<script src="{{ asset('/js/clndr.js')}}"></script>
<div class="container-fluid">
    <div class="row">
        <div class="offset-1 col-10 offset-lg-1 col-lg-7 main-content">
            <h3 class="heading">{{ $display_date }}</h3>
            <div class="table-responsive">
                @if($spends != null)
                <table class="table table-sm table-bordered table-striped table-hover">

                    <thead class="thead-light">
                        <tr>
                            <th scope="col" class="align-middle text-nowrap text-center">費目</th>
                            <th scope="col" class="align-middle text-nowrap text-center">内容</th>
                            <th scope="col" class="align-middle text-nowrap text-center">金額</th>
                        </tr>
                    </thead>

                    <!-- 家計簿データ -->

                    <tbody data-placement="right">
                        @foreach($spends as $spend)
                        <tr data-toggle="modal" data-target="#staticBackdrop">
                            <td class="align-middle text-center text-nowrap">{{ $spend->name }}</td>
                            <td class="align-middle">{{ $spend->content }}</td>
                            <td class="align-middle text-right text-nowrap">{{ $spend->amount }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <h2>本日の入力データはありません。</h2>
                @endif
            </div>
        </div><!-- col -->

        <div class="col-lg-3">
            <div class="row">
                <div class="offset-1 col-10 offset-lg-1 col-lg-11 sidebar-content">
                    <!-- カレンダー-->
                    <div class="row">
                        <div class="col">
                            <div id="clndr"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="title title0">
                                <h3 class="heading">{{ $year }}年{{ $month }}月の費目ごとの<br>消費額</h3>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-Light table-hover table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-center">費目</th>
                                            <th class="text-center">金額</th>
                                        </tr>
                                    </thead>
                                    @foreach($monthly_consumptions as $data)
                                    <tr>
                                        <td class="text-center">{{ $data->name }}</td>
                                        <td class="text-center">{{ $data->total }}円</td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- 入れ子col -->
            </div><!-- 入れ子row -->
        </div><!-- col -->

    </div><!-- row -->
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

<!-- カレンダー生成 -->
<script type="text/javascript">
    $('#clndr').clndr();

</script>

@endsection
