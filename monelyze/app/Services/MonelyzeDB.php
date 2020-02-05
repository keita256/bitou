<?php

namespace App\Services;

use DB;
use App\Services\MonthlyDataLogic;
use App\Services\DAO\SpendDAO;
use App\Services\DAO\MonthlyInputDAO;
use App\Services\DAO\PaymentDAO;
use App\Services\DAO\ExpenseDAO;
use App\Services\DAO\UserDAO;
use App\Services\DAO\StatisticsDAO;
use App\Services\DTO\StatisticsDTO;

class MonelyzeDB
{
    private $spendDAO;
    private $monthlyInputDAO;
    private $paymentDAO;
    private $expenseDAO;
    private $userDAO;
    private $statisticsDAO;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->spendDAO = new SpendDAO();
        $this->monthlyInputDAO = new MonthlyInputDAO();
        $this->paymentDAO = new PaymentDAO();
        $this->expenseDAO = new ExpenseDAO();
        $this->userDAO = new UserDAO();
        $this->statisticsDAO = new StatisticsDAO();
    }

    /*************************************** get ****************************************/
    // user_idをもとにユーザネームを取得
    public function getUserName($user_id)
    {
        return $this->userDAO->getUserName($user_id);
    }

    // user_idをもとにeメールを取得
    public function getUserMail($user_id)
    {
        return $this->userDAO->getUserMail($user_id);
    }

    // すべての費目レコードを取得
    public function getExpense()
    {
        return $this->expenseDAO->getExpense();
    }

    // 引数をもとにspendデータを取得
    public function getSpends($user_id, $date)
    {
        return $this->spendDAO->getSpends($user_id, $date);
    }

    // 引数をもとにpaymentデータを取得
    public function getPayments($user_id, $year, $month)
    {
        return $this->paymentDAO->getPayments($user_id, $year, $month);
    }

    // 引数をもとにmonthlyInputデータを取得
    public function getMonthlyInput($user_id, $year, $month)
    { 
        return $this->monthlyInputDAO->getMonthlyInput($user_id, $year, $month);
    }

    /*************************************** insert ****************************************/

    // spendデータを登録
    public function insertSpends($user_id, $date, $spends)
    {
        $this->spendDAO->insertSpends($user_id, $date, $spends);
    }

    // paymentデータを登録
    public function insertPayments($user_id, $year, $month, $payments)
    { 
        return $this->paymentDAO->insertPayments($user_id, $year, $month, $payments);
    }

    // monthlyInputデータを登録
    public function insertMonthlyInput($user_id, $year, $month, $take_amount, $target_spending)
    {
        return $this->monthlyInputDAO->insertMonthlyInput($user_id, $year, $month, $take_amount, $target_spending);
    }

    /*************************************** update ****************************************/

    // spendデータを更新
    public function updateSpend($user_id, $date, $number, $expense_id, $content, $amount)
    {
        return $this->spendDAO->updateSpend($user_id, $date, $number, $expense_id, $content, $amount);
    }

    // paymentデータを更新
    public function updatePayment($user_id, $year, $month, $number, $content, $amount)
    {
        return $this->paymentDAO->updatePayment($user_id, $year, $month, $number, $content, $amount);
    }

    // monthlyInputデータを更新
    public function updateMonthlyInput($user_id, $year, $month, $take_amount, $target_spending)
    {
        return $this->monthlyInputDAO->updateMonthlyInput($user_id, $year, $month, $take_amount, $target_spending);
    }

    // ユーザネームを更新
    public function updateUserName($user_id, $new_name)
    {
        return $this->userDAO->updateUserName($user_id, $new_name);
    }

    // ユーザメールを更新
    public function updateUserMail($user_id, $new_email)
    {
        $this->userDAO->updateUserMail($user_id, $new_email);
    }

    /*************************************** delete ****************************************/

    // spendデータを削除
    public function deleteSpend($user_id, $date, $number)
    {
        return $this->spendDAO->deleteSpend($user_id, $date, $number);
    }

    // paymentデータを削除
    public function deletePayment($user_id, $year, $month, $number)
    {
        return $this->paymentDAO->deletePayment($user_id, $year, $month, $number);
    }

    /*************************************** データが存在するか ****************************************/

    // user_idをもとにデータが存在するか取得
    public function isEmptyMonthlyData($user_id, $year)
    {
        return $this->monthlyInputDAO->isEmptyMonthlyData($user_id, $year);
    }

    // 指定された年月の月初入力レコードが存在するか取得(middlewareで使用)
    public function isEmptyMonthlyInput($user_id, $year, $month)
    {
        return $this->monthlyInputDAO->isEmptyMonthlyInput($user_id, $year, $month);
    }

    /*************************************** 統計データの取得 ****************************************/

    // 指定された年の月ごとの消費額を取得(固定費を含まない)
    public function getMonthlyConsumption($user_id, $year)
    {
        return $this->statisticsDAO->getMonthlyConsumption($user_id, $year);
    }

    // 指定された年の月ごとの固定費を取得
    public function getMonthlyFixedCosts($user_id, $year)
    {
        return $this->statisticsDAO->getMonthlyFixedCosts($user_id, $year);
    }

    // 指定された年の月ごとの目標支出の取得
    public function getMonthlyTargetSpending($user_id, $year)
    {
        return $this->statisticsDAO->getMonthlyTargetSpending($user_id, $year);
    }

    // 指定された年の月ごとの手取り収入を取得
    public function getMonthlyTakeAmount($user_id, $year)
    {
        return $this->statisticsDAO->getMonthlyTakeAmount($user_id, $year);
    }

    // 指定された年の月ごとの消費額(固定費を含む)を取得し配列で返す
    public function getTotalMonthlyConsumption($user_id, $year)
    {
        // 初期化
        $total_monthly_consumption = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];    // 1月から12月のデータ
        $monthly_consumption = $this->getMonthlyConsumption($user_id, $year); // 月ごとの消費額
        $monthly_fixed_costs = $this->getMonthlyFixedCosts($user_id, $year);  // 月ごとの固定費

        // オブジェクトを配列に変換
        $monthly_consumption = MonthlyDataLogic::monthlyDataToArray($monthly_consumption);
        $monthly_fixed_costs = MonthlyDataLogic::monthlyDataToArray($monthly_fixed_costs);

        // 配列の要素ごとに加算
        $total_monthly_consumption = MonthlyDataLogic::addArrayElement($total_monthly_consumption, $monthly_consumption);
        $total_monthly_consumption = MonthlyDataLogic::addArrayElement($total_monthly_consumption, $monthly_fixed_costs);
        
        return $total_monthly_consumption;
    }

    // 指定された年の月ごとの節約額を取得( 目標支出 - 消費額(固定費を含む) )
    public function getMonthlySavings($user_id, $year)
    {
        // 初期化
        $monthly_savings = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];                         // 1月から12月のデータ
        $total_monthly_consumption = $this->getTotalMonthlyConsumption($user_id, $year); // 月ごとの消費額(固定費を含む)
        $monthly_target_spending = $this->getMonthlyTargetSpending($user_id, $year);     // 月ごとの目標支出

        // オブジェクトを配列に変換
        $monthly_target_spending = MonthlyDataLogic::monthlyDataToArray($monthly_target_spending);

        // 配列の要素ごとに加算、減算
        $monthly_savings = MonthlyDataLogic::addArrayElement($monthly_savings, $monthly_target_spending);
        $monthly_savings = MonthlyDataLogic::subtractArrayElement($monthly_savings, $total_monthly_consumption);

        return $monthly_savings;
    }

    // 指定された年の月ごとの残金を取得( 手取り収入 - 消費額(固定費を含む) )
    public function getMonthlyBalance($user_id, $year)
    {
        // 初期化
        $monthly_balance = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]; // 1月から12月のデータ
        $monthly_take_amount = $this->getMonthlyTakeAmount($user_id, $year);             // 月ごとの手取り収入を取得
        $total_monthly_consumption = $this->getTotalMonthlyConsumption($user_id, $year); // 月ごとの消費額を取得(固定費を含む)

        // オブジェクトを配列に変換
        $monthly_take_amount = MonthlyDataLogic::monthlyDataToArray($monthly_take_amount);

        // 配列の要素ごとに加算、減算
        $monthly_balance = MonthlyDataLogic::addArrayElement($monthly_balance, $monthly_take_amount);
        $monthly_balance = MonthlyDataLogic::subtractArrayElement($monthly_balance, $total_monthly_consumption);

        return $monthly_balance;
    }

    // 指定された年月の費目ごとの消費額を取得
    public function getExpenseConsumption($user_id, $year, $month)
    {
        return $this->statisticsDAO->getExpenseConsumption($user_id, $year, $month);
    }

    public function getStatistics($user_id, $year)
    {
        // 変数宣言、初期化
        $statisticsDTO = new StatisticsDTO(); // 統計情報を保存するクラス
        $monthly_consumption;                 // 月ごとの消費額(固定費を含まない)
        $monthly_fixed_costs;                 // 月ごとの固定費
        $monthly_target_spending;             // 月ごとの目標支出
        $monthly_take_amount;                 // 月ごとの収入
        $total_monthly_consumption = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]; // 月ごとの消費額(固定費を含む)
        $monthly_savings = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];           // 月ごとの節約額
        $monthly_balance = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];           // 月ごとの残金
        $annual_consumption;  // 年間消費額
        $annual_savings;      // 年間節約額
        $annual_balance;      // 年間残金

        // データが存在しなければデータがないオブジェクトをreturn
        if(!$this->monthlyInputDAO->isEmptyMonthlyData($user_id, $year)) {
            $monthly_consumption = [];
            $monthly_fixed_costs = [];
            $annual_consumption = 0;
            $annual_savings = 0;
            $annual_balance = 0;

            $statisticsDTO->setMonthlyConsumption($monthly_consumption);
            $statisticsDTO->setMonthlyFixedCosts($monthly_fixed_costs);
            $statisticsDTO->setMonthlySavings($monthly_savings);
            $statisticsDTO->setMonthlyBalance($monthly_balance);
            $statisticsDTO->setAnnualConsumption($annual_consumption);
            $statisticsDTO->setAnnualSavings($annual_savings);
            $statisticsDTO->setAnnualBalance($annual_balance);

            return $statisticsDTO;
        }

        // 月ごとの消費額(固定費を含まない)を取得し、配列[12]に変換
        $monthly_consumption = $this->statisticsDAO->getMonthlyConsumption($user_id, $year);
        $monthly_consumption = MonthlyDataLogic::monthlyDataToArray($monthly_consumption);
        // 月ごとの固定費を取得し、配列[12]に変換
        $monthly_fixed_costs = $this->statisticsDAO->getMonthlyFixedCosts($user_id, $year);
        $monthly_fixed_costs = MonthlyDataLogic::monthlyDataToArray($monthly_fixed_costs);
        // monthly_consumptionとmonthly_fixed_costsからtotal_monthly_consumptionを作成
        $total_monthly_consumption = MonthlyDataLogic::addArrayElement($total_monthly_consumption, $monthly_consumption);
        $total_monthly_consumption = MonthlyDataLogic::addArrayElement($total_monthly_consumption, $monthly_fixed_costs);

        // 月ごとの目標支出を取得し、配列[12]に変換
        $monthly_target_spending = $this->statisticsDAO->getMonthlyTargetSpending($user_id, $year);
        $monthly_target_spending = MonthlyDataLogic::monthlyDataToArray($monthly_target_spending);
        // monthly_target_spendingと$total_monthly_consumptionからmonthly_savingsを作成
        $monthly_savings = MonthlyDataLogic::addArrayElement($monthly_savings, $monthly_target_spending);
        $monthly_savings = MonthlyDataLogic::subtractArrayElement($monthly_savings, $total_monthly_consumption);

        // 月ごとの収入を取得し、配列[12]に変換
        $monthly_take_amount = $this->statisticsDAO->getMonthlyTakeAmount($user_id, $year);
        $monthly_take_amount = MonthlyDataLogic::monthlyDataToArray($monthly_take_amount);
        // monthly_take_amountとtotal_monthly_consumptionからmonthly_balanceを作成
        $monthly_balance = MonthlyDataLogic::addArrayElement($monthly_balance, $monthly_take_amount);
        $monthly_balance = MonthlyDataLogic::subtractArrayElement($monthly_balance, $total_monthly_consumption);

        // 年間消費額を取得
        $annual_consumption = array_sum($total_monthly_consumption);

        // 年間節約額を取得
        $annual_savings = array_sum($monthly_savings);

        // 年間残金を取得
        $annual_balance = array_sum($monthly_balance);

        // DTOに統計データを代入
        $statisticsDTO->setMonthlyConsumption($monthly_consumption);
        $statisticsDTO->setMonthlyFixedCosts($monthly_fixed_costs);
        $statisticsDTO->setMonthlySavings($monthly_savings);
        $statisticsDTO->setMonthlyBalance($monthly_balance);
        $statisticsDTO->setAnnualConsumption($annual_consumption);
        $statisticsDTO->setAnnualSavings($annual_savings);
        $statisticsDTO->setAnnualBalance($annual_balance);

        return $statisticsDTO;
    }
}
?>