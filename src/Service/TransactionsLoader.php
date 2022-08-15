<?php

namespace Service;

class TransactionsLoader
{
    private $transactionsStorage;

    public function __construct(TransactionsStorageInterface $transactionsStorage)
    {
        $this->transactionsStorage = $transactionsStorage;
    }

    public function getTransactions()
    {
        $transactions = [];

        $transactionsData = $this->queryForTransactions();

        return $transactionsData;
    }

    private function queryForTransactions()
    {
        try {
            return $this->transactionsStorage->fetchAllTransactionsData();
        } catch (\PDOException $e) {
            trigger_error('Database Exception! ' . $e->getMessage());
            return [];
        }
    }
}