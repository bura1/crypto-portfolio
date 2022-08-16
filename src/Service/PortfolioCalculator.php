<?php

namespace Service;

class PortfolioCalculator
{
    private $transactions;

    public function __construct($transactions)
    {
        $this->transactions = $transactions;
    }

    public function getPortfolio()
    {
        $portfolio = $this->sumTransactions();

        return $portfolio;
    }

    public function sumTransactions()
    {
        $sum = [];

        foreach ($this->transactions as $transaction) {
            if (array_key_exists($transaction['symbol'], $sum)) {
                $sum[$transaction['symbol']] += (double) $transaction['value'];
            } else {
                $sum[$transaction['symbol']] = (double) $transaction['value'];
            }
        }

        return array_filter($sum);
    }
}