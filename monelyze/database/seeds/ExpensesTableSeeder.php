<?php

use Illuminate\Database\Seeder;

class ExpensesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // テーブルのクリア
        //DB::table('expenses')->truncate();

        // 費目データ
        $expenses = [
            [
                'name' => '食費',
                'description' => '毎日の食事で必要な食料や飲料、調味料など',
            ],
            [
                'name' => '日用品費',
                'description' => '生活するために必要な消耗品や住居備品',
            ],
            [
                'name' => '医療費',
                'description' => '病院にかかった際の診察代をはじめ、薬代や病院への交通費',
            ],
            [
                'name' => '交通費',
                'description' => '電車やバス、タクシーなどの公共交通機関を使用したときの費用',
            ],
            [
                'name' => '交際費',
                'description' => 'お付き合いとしての飲み会代や会食代、プレゼント代、手土産代など',
            ],
            [
                'name' => '娯楽費',
                'description' => '余暇時間・自由時間にまつわる費用',
            ],
            [
                'name' => '美容・被服費',
                'description' => '美容院や洋服などにかかる費用',
            ],
            [
                'name' => 'その他',
                'description' => '他のカテゴリに当てはまらない費用',
            ],
        ];

        // 登録
        foreach ($expenses as $expense) {
            \App\Expense::create($expense);
        }
    }
}
