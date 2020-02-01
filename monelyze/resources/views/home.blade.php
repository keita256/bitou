@extends('layouts.common')

@section('title', 'ホーム')
@include('layouts.head')

@include('layouts.header')

@section('content')
<script src="{{ asset('/js/clndr.js')}}"></script>
<div class="container-fluid">
    <div class="row">
        <div class="offset-1 col-10 offset-lg-1 col-lg-7 main-content">
            <a href="/monthlyInput/{{ $year }}/{{ $month }}">月初入力</a>
            <h3 class="heading">{{ $year }}年{{ $month }}月{{ $day }}日</h3>

            @if($spends != null)
            <div class="table-responsive">
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
                        <tr class="modal-event" data-toggle="modal" data-target="#staticBackdrop">
                            <td class="align-middle text-center text-nowrap" value="{{ $spend->expense_id }}">{{ $spend->name }}</td>
                            <td class="align-middle">{{ $spend->content }}</td>
                            <td class="align-middle text-center text-nowrap">{{ $spend->amount }}円</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <h2 class="text-center">本日の入力データはありません。</h2>
            @endif
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
                                <h3 class="heading">{{ $year }}年{{ $month }}月の統計</h3>
                            </div>

                            <h4>月初入力情報</h4>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col" class="align-middle text-nowrap text-center">収入</th>
                                            <th scope="col" class="align-middle text-nowrap text-center">目標支出</th>
                                        </tr>
                                    </thead>
                
                                    <!-- 月初入力データ -->
                
                                    <tbody data-placement="right">
                                        @foreach($monthly_input as $mi)
                                        <tr data-toggle="modal" data-target="#staticBackdrop">
                                            <td class="align-middle text-center text-nowrap">{{ $mi->take_amount }}円</td>
                                            <td class="align-middle text-center text-nowrap">{{ $mi->target_spending }}円</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <h4>費目ごとの消費額</h4>

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-center">費目</th>
                                            <th class="text-center">金額</th>
                                        </tr>
                                    </thead>
                                    @foreach($monthly_expense_consumptions as $mec)
                                    <tr>
                                        <td class="text-center">{{ $mec->name }}</td>
                                        <td class="text-center">{{ $mec->total }}円</td>
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
<div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">家計簿編集</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="input1">費目の選択</label>
                        <select class="form-control" id="input1">
                            @foreach($expenses as $e)
                            <option value="{{ $e->expense_id }}">{{ $e->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="input2">内容</label>
                        <input type="text" class="form-control" id="input2" placeholder="内容を記入">
                    </div>

                    <div class="form-group">
                        <label for="input3">金額</label>
                        <input type="text" class="form-control" id="input3" placeholder="金額を記入">
                    </div>

                    <button type="button" class="btn btn-primary">変更を確定</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                </form>
            </div>

            
        </div>
    </div>
</div>

<script>
    $(".modal-event").click(function() {
        const expense = this.children[0].getAttribute("value");
        const content = this.children[1].textContent;
        const amount = this.children[2].textContent;

        //設定
        $("#input1").val(expense);
        $("#input2").val(content);
        $("#input3").val(amount);
    });
</script>

<!-- カレンダー生成 -->
<script type="text/javascript">
    $('#clndr').clndr();

</script>

@endsection