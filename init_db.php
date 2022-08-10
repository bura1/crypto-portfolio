<?php

// Settings
const DBNAME = 'portfolio';

// Create database
if (!mkdir('database') && !is_dir('database')) {
    throw new \RuntimeException(sprintf('Directory "%s" was not created', 'database'));
}
fopen('database/' . DBNAME . '.db', 'wb');
$pdo = new PDO('sqlite:database/portfolio.db');