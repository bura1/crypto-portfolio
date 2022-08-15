<?php

use Service\Container;

require __DIR__.'/bootstrap.php';

$container = new Container($configuration);

$transactions = $container->getTransactionsLoader();

dd($transactions->getTransactions());