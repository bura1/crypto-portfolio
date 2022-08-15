<?php

namespace Service;

class Container
{
    private $configuration;
    private $pdo;
    private $transactionsStorage;
    private $transactionsLoader;

    public function __construct(array $configuration)
    {
        $this->configuration = $configuration;
    }

    public function getPDO()
    {
        if ($this->pdo === null) {
            $this->pdo = new \PDO(
                $this->configuration['db_dsn']
            );

            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }

        return $this->pdo;
    }

    public function getTransactionsLoader()
    {
        if ($this->transactionsLoader === null) {
            $this->transactionsLoader = new TransactionsLoader($this->getTransactionsStorage());
        }

        return $this->transactionsLoader;
    }

    public function getTransactionsStorage()
    {
        if ($this->transactionsStorage === null) {
            $this->transactionsStorage = new PdoTransactionsStorage($this->getPDO());
        }

        return $this->transactionsStorage;
    }
}