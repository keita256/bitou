@extends('layouts.common')

@section('title', '統計ページ')
@include('layouts.head')

@include('layouts.header')

@section('content')

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="offset-1 col-10 content-div">
                <!-- background-color:white -->
                <h1>{{ $year }}年度、家計簿統計情報</h1>

                <div class="row">
                    <div class="offset-1 col-10 graph-div">
                        <!-- background-color:blue -->
                        <h3>月毎の消費額</h3>

                        <div class="row">
                            <div class="col-lg-8">
                                <canvas id="consumptionChart"></canvas>
                            </div>

                            <div class="col-lg-4">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="align-middle text-center text-nowrap">年間消費額</th>
                                            <td class="align-middle text-center text-nowrap">{{ $annual_consumption }}円
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- row -->

                <div class="row">
                    <div class="offset-1 col-10 graph-div">
                        <h3>月毎の節約額</h3>

                        <div class="row">
                            <div class="col-lg-8">
                                <canvas id="savingChart"></canvas>
                            </div>

                            <div class="col-lg-4">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="align-middle text-center text-nowrap">年間節約額</th>
                                            <td class="align-middle text-center text-nowrap">{{ $annual_savings }}円</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- row -->

                <div class="row">
                    <div class="offset-1 col-10 graph-div-last">
                        <h3>月毎の残金</h3>

                        <div class="row">
                            <div class="col-lg-8">
                                <canvas id="balanceChart"></canvas>
                            </div>

                            <div class="col-lg-4">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="align-middle text-center text-nowrap">年間残金</th>
                                            <td class="align-middle text-center text-nowrap">{{ $annual_balance }}円</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- row -->

                <div class="row">
                    <div class="col">
                        <ul class="pagination justify-content-center">
                            <li class="page-item"><a class="page-link" href="#">前へ</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">次へ</a></li>
                        </ul>
                    </div>
                </div>

            </div><!-- col -->
        </div><!-- row -->
    </div><!-- container -->
</body>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// 変数宣言、初期化
let monthlyTotal = @json($total_monthly_consumption);
let monthlySavings = @json($monthly_savings);
let monthlyBalance = @json($monthly_balance);
let year = @json($year);
let month = ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"];
let ctx1 = $('#consumptionChart');
let ctx2 = $('#savingChart');
let ctx3 = $('#balanceChart');

createChart(ctx1, monthlyTotal, '消費額');
createChart(ctx2, monthlySavings, '節約額');
createChart(ctx3, monthlyBalance, '残金');

// functions
function createChart(ctx, monthData, barName) {
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
                        callback: function(value, index, values) {
                            return value + '円';
                        }
                    }
                }]
            }
        }
    });
}
</script>
@endsection