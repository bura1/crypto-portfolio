<?php

namespace Service;

class PdoTransactionsStorage implements TransactionsStorageInterface
{
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function fetchAllTransactionsData()
    {
        $statement = $this->pdo->prepare('SELECT * FROM transactions');
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
}