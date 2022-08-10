<?php

use Service\CsvLoader;

require __DIR__.'/bootstrap.php';

const DB_NAME = 'portfolio';
const CSV_FILE = 'files/tickers.csv';

$db = createDatabase(DB_NAME);
createTables($db);
$coins = getCoinsFromCsvFile(CSV_FILE);
insertData($db, $coins);

// Helper functions

function createDatabase($dbName)
{
    if (!is_dir('database')) {
        mkdir('database');
    }
    fopen('database/' . $dbName . '.db', 'wb');

    return new PDO('sqlite:database/portfolio.db');
}

function createTables($dbi)
{
    $dbi->exec('DROP TABLE IF EXISTS coins;');

    $dbi->exec(
        'CREATE TABLE coins (
        id INTEGER PRIMARY KEY,
        name TEXT NOT NULL,
        symbol TEXT NOT NULL)'
    );

    $dbi->exec(
        'CREATE TABLE transactions (
        id INTEGER PRIMARY KEY,
        symbol TEXT NOT NULL,
        value TEXT NOT NULL,
        FOREIGN KEY(symbol) REFERENCES coins(symbol))'
    );
}

function getCoinsFromCsvFile($csvFile)
{
    $csvLoader = new CsvLoader();
    return $csvLoader->getData($csvFile);
}

function insertData($dbi, $allCoins)
{
    $coinsString = getStringOfCoins($allCoins);

    $dbi->exec(
        'INSERT INTO "coins" ("name", "symbol") VALUES ' . $coinsString
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