<?php

use Service\CsvLoader;

require __DIR__.'/bootstrap.php';

// Settings
const DBNAME = 'portfolio';

// Create database
if (!is_dir('database')) {
    mkdir('database');
}
fopen('database/' . DBNAME . '.db', 'wb');
$db = new PDO('sqlite:database/portfolio.db');

createTables($db);
$coins = getCoinsFromCsvFile();
insertData($db, $coins);

function createTables($dbi)
{
    $dbi->exec('DROP TABLE IF EXISTS coin;');

    $dbi->exec(
        'CREATE TABLE coin (
        id INTEGER PRIMARY KEY,
        name TEXT NOT NULL,
        symbol TEXT NOT NULL)'
    );
}

function getCoinsFromCsvFile()
{
    $csvLoader = new CsvLoader();
    return $csvLoader->getData('files/tickers.csv');
}

function insertData($dbi, $allCoins)
{
    $coinsString = getStringOfCoins($allCoins);

    $dbi->exec(
        'INSERT INTO "coin" ("name", "symbol") VALUES ' . $coinsString
    );
}

function getStringOfCoins($allCoins)
{
    $string = '';
    foreach ($allCoins as $coin) {
        $string .= '("'. $coin[0] .'", "'. $coin[1] .'"),';
    }

    return substr_replace($string, ";", -1);
}