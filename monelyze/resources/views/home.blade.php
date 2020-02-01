@extends('layouts.common')

@section('title', 'ホーム')
@include('layouts.head')

@include('layouts.header')

@section('content')
<script src="{{ asset('/js/clndr.js')}}"></script>
<div class="container-fluid">
    <div class="row">
        <div class="offset-1 col-10 offset-lg-1 col-lg-7 main-content">
            <!-- 月初入力されてない場合、入力を促す文字列表示 -->
            @if(!$monthly_input_data_is_empty)
            <u>
                <p class="text-center" style="border-color: red;">※月初入力情報を<a href="/monthlyInput/{{ $year }}/{{ $month }}">ここから</a>入力してください。</p>
            </u>
            @endif

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
                            <td style="display:none">{{ $spend->number}}</td>
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
                                        @if($monthly_input == null)
                                            <td class="align-middle text-center text-nowrap">0円</td>
                                            <td class="align-middle text-center text-nowrap">0円</td>
                                        @endif
                                        @foreach($monthly_input as $mi)
                                        <tr class="modalMonthly" data-toggle="modal" data-target="#monthlyInput">
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
<div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">家計簿編集</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="/spend" method="post" class="changeAction" id="spendForm" accept-charset="UTF-8">
                    @csrf
                    <div class="form-group">
                        <label for="input1">費目の選択</label>
                        <select class="form-control" id="input1" name="expense_id">
                            @foreach($expenses as $e)
                            <option value="{{ $e->expense_id }}">{{ $e->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="input2">内容</label>
                        <input type="text" class="form-control" id="input2" name="content" placeholder="内容を記入">
                    </div>

                    <div class="form-group">
                        <label for="input3">金額</label>
                        <input type="text" class="form-control" id="input3" name="amount" placeholder="金額を記入">
                    </div>

                    <input type="hidden" name="number" id="setVal" value="">
                    <input type="hidden" name="spend_date" value="{{ $year }}-{{ $month }}-{{ $day }}">

                    <div class="pull-left">
                        <button class="btn btn-primary btn-sm" onclick="setAction('/spend/delete')">削除する</button>
                    </div>
                    <div class="pull-right">
                        <button class="btn btn-primary" onclick="setAction('/spend/edit')">変更を確定</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="monthlyInput" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">月初入力編集</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="/monthlyInput/{{ $year }}/{{ $month }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="income">収入</label>
                        <input type="number" class="form-control" id="income" name="take_amount" require>
                    </div>

                    <div class="form-group">
                        <label for="">目標支出</label>
                        <input type="number" class="form-control" id="target" name="target_spending" require>
                    </div>

                    <div class="pull-right">
                        <button class="btn btn-primary">変更を確定</button>
                    </div>
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
        const number = this.children[3].textContent;

        const setAmount = amount.replace('円', '');
        //設定
        $("#input1").val(expense);
        $("#input2").val(content);
        $("#input3").val(setAmount);
        $("#setVal").val(number);
    });

    $(".modalMonthly").click(function() {
        const income = this.children[0].textContent;
        const target = this.children[1].textContent;

        const setIncome = income.replace('円', '');
        const setTarget = target.replace('円', '');
        //設定
        $("#income").val(setIncome);
        $("#target").val(setTarget);
    });
</script>

<script src="{{ asset('js/form.js') }}"></script>

<!-- カレンダー生成 -->
<script type="text/javascript">
    $('#clndr').clndr();
</script>

@endsection