@extends('layouts.common')

@section('title', '統計ページ')
@include('layouts.head')

@include('layouts.header')

@section('content')

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 offset-sm-1 col-sm-10 page-div">
                <!-- background-color:white -->
                <h1 class="responsive-font-size">
                    {{ $year }}年 家計簿統計情報
                </h1>

                <!-- <button class="float-right btn-sm btn-primary text-nowrap" data-toggle="modal" data-target="#yearChange" style="margin: 10px 0px 5px 0px;">年月変更</button> -->

                <div class="row">
                    <div class="offset-1 col-10 content-div">
                        <!-- background-color:blue -->
                        <h3 class="responsive-font-size">月毎の消費額</h3>

                        <div class="row">
                            <div class="col-lg-8">
                                <canvas id="consumptionChart"></canvas>
                            </div>

                            <div class="col-lg-4">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="align-middle text-center text-nowrap">年間消費額</th>
                                            <td class="align-middle text-center text-nowrap">{{ $statistics_data->getAnnualConsumption() }}円
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- row -->

                <div class="row">
                    <div class="offset-1 col-10 content-div">
                        <h3 class="responsive-font-size">月毎の節約額</h3>

                        <div class="row">
                            <div class="col-lg-8">
                                <canvas id="savingChart"></canvas>
                            </div>

                            <div class="col-lg-4">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="align-middle text-center text-nowrap">年間節約額</th>
                                            <td class="align-middle text-center text-nowrap">{{ $statistics_data->getAnnualSavings() }}円</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- row -->

                <div class="row">
                    <div class="offset-1 col-10 content-div-last">
                        <h3 class="responsive-font-size">月毎の残金</h3>

                        <div class="row">
                            <div class="col-lg-8">
                                <canvas id="balanceChart"></canvas>
                            </div>

                            <div class="col-lg-4">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="align-middle text-center text-nowrap">年間残金</th>
                                            <td class="align-middle text-center text-nowrap">{{ $statistics_data->getAnnualBalance() }}円</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- row -->

            </div><!-- col -->
        </div><!-- row -->
    </div><!-- container -->
</body>

<!-- モーダルの設定 -->
<div class="modal fade" id="yearChange" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">年変更</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="" method="get" class="form-inline justify-content-between dateForm" accept-charset="UTF-8">
                        @csrf
                        <div class="form-row">
                            <select class="form-controlle" id="selectYear">
                                @for ($i = $year - 3; $i <= $year + 3; $i++)
                                    @if ($year == $i)
                                        <option value="{{ $i }}" selected>{{ $i }}</option>
                                        @continue
                                    @endif
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            <div>年</div>
                        </div>

                        <button class="btn btn-primary pull-right yearChange">表示</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script src="{{ asset('js/form.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// 変数宣言、初期化
let monthlyFixedCosts = @json($statistics_data->getMonthlyFixedCosts());
let monthlyConsumption = @json($statistics_data->getMonthlyConsumption());
let monthlySavings = @json($statistics_data->getMonthlySavings());
let monthlyBalance = @json($statistics_data->getMonthlyBalance());
let year = @json($year);
let consumptionChart = $('#consumptionChart');
let savingChart = $('#savingChart');
let balanceChart = $('#balanceChart');

// グラフ生成
createStackedBarChart(consumptionChart, monthlyFixedCosts, monthlyConsumption, '固定費', '消費額');
createBarChart(savingChart, monthlySavings, '節約額');
createBarChart(balanceChart, monthlyBalance, '残金');

// functions
function createBarChart(ctx, monthData, barName) {
    let month = ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"];

    let barChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: month,
            datasets: [{
                label: barName,
                data: monthData,
                backgroundColor: "rgba(153, 255, 51, 1)"
            }]
        },

        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        suggestedMin: 0,
                    }
                }]
            }
        }
    });
}

function createStackedBarChart(ctx, paymentData, consumptionData, label1, label2) {
    let month = ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"];

    let barChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: month,
            datasets: [{
                    label: label1,
                    data: paymentData,
                    backgroundColor: "green"
                },
                {
                    label: label2,
                    data: consumptionData,
                    backgroundColor: "rgba(153, 255, 51, 1)"
                }
            ]
        },

        options: {
            scales: {
                xAxes: [{
                    stacked: true
                }],

                yAxes: [{
                    ticks: {
                        suggestedMin: 0,
                    },

                    stacked: true
                }]
            }
        }
    });
}
</script>
@endsection