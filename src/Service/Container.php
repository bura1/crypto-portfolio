<?php

namespace Service;

class Container
{
    private $dbConfiguration;
    private $pdo;
    private $transactionsStorage;
    private $transactionsLoader;
    private $portfolioLoader;

    public function __construct(array $dbConfiguration)
    {
        $this->dbConfiguration = $dbConfiguration;
    }

    public function getPDO()
    {
        if ($this->pdo === null) {
            $this->pdo = new \PDO(
                $this->dbConfiguration['db_dsn']
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

    public function getPortfolio($nomicsApiKey, $convert)
    {
        if ($this->portfolioLoader === null) {
            $this->portfolioLoader = new PortfolioManager($this->getTransactionsLoader()->getTransactions(), $nomicsApiKey, $convert);
        }

        return $this->portfolioLoader->getPortfolio();
    }
}