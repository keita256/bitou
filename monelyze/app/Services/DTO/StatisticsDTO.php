<?php

namespace App\Services\DTO;

class StatisticsDTO
{
    private $monthly_consumption; // 月ごとの消費額(固定費を含まない)
    private $monthly_fixed_costs; // 月ごとの固定費
    private $monthly_savings;     // 月ごとの節約額
    private $monthly_balance;     // 月ごとの残金
    private $annual_consumption;  // 年間消費額
    private $annual_savings;      // 年間節約額
    private $annual_balance;      // 年間残金

    public function getMonthlyConsumption()
    {
        return $this->monthly_consumption;
    }

    public function setMonthlyConsumption($monthly_consumption)
    {
        $this->monthly_consumption = $monthly_consumption;
    }

    public function getMonthlyFixedCosts()
    {
        return $this->monthly_fixed_costs;
    }

    public function setMonthlyFixedCosts($monthly_fixed_costs)
    {
        $this->monthly_fixed_costs = $monthly_fixed_costs;
    }

    public function getMonthlySavings()
    {
        return $this->monthly_savings;
    }

    public function setMonthlySavings($monthly_savings)
    {
        $this->monthly_savings = $monthly_savings;
    }

    public function getMonthlyBalance()
    {
        return $this->monthly_balance = $monthly_balance;
    }

    public function setMonthlyBalance($monthly_balance)
    {
        $this->monthly_balance = $monthly_balance;
    }

    public function getAnnualConsumption()
    {
        return $this->annual_consumption = $annual_consumption;
    }

    public function setAnnualConsumption($annual_consumption)
    {
        $this->annual_consumption = $annual_consumption;
    }

    public function getAnnualSavings()
    {
        return $this->annual_savings;
    }

    public function setAnnualSavings($annual_savings)
    {
        $this->annual_savings = $annual_savings;
    }

    public function getAnnualBalance()
    {
        $this->annual_balance;
    }

    public function setAnnualBalance($annual_balance)
    {
        $this->annual_balance = $annual_balance;
    }
}

?>