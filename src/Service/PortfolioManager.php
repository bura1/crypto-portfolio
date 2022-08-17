<?php

namespace Service;

use Http\NomicsApi;

class PortfolioManager
{
    private $transactions;
    private $nomicsApiKey;
    private $convert;

    public function __construct($transactions, $nomicsApiKey, $convert)
    {
        $this->transactions = $transactions;
        $this->nomicsApiKey = $nomicsApiKey;
        $this->convert = $convert;
    }

    public function getPortfolio()
    {
        $portfolio = $this->sumTransactions();

        $portfolioWithPrice = $this->priceOfPortfolio($portfolio);

        return $portfolioWithPrice;
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

    public function priceOfPortfolio($portfolio)
    {
        $nomics = new NomicsApi($this->nomicsApiKey);

        $tickers = implode(',', array_keys($portfolio));
        $requestResult = json_decode($nomics->getDataForTickers($tickers, $this->convert), true);

        $items = [];
        foreach ($portfolio as $ticker => $amount) {
            $value = $this->valueOfCoin($ticker, $amount, $requestResult);
            $items[] = [$ticker, $amount, $value];
        }

        return $items;
    }

    public function valueOfCoin($ticker, $amount, $requestResult)
    {
        foreach ($requestResult as $row) {
            if ($row['symbol'] === $ticker) {
                return (double) ($row['price'] * $amount);
            }
        }

        return 0;
    }
}