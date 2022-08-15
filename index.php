<?php

use Service\TransactionsLoader;
use Service\PdoTransactionsStorage;

require __DIR__.'/bootstrap.php';

?>

<a href="/transaction.php">Add transaction</a>

<?php

$pdo = new PDO('sqlite:database/portfolio.db');
$storage = new PdoTransactionsStorage($pdo);
$transactions = new TransactionsLoader($storage);

dd($transactions->getTransactions());