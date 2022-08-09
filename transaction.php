<?php

use Service\CsvLoader;

require __DIR__.'/bootstrap.php';

$coinsCsv = new CsvLoader();
$coins = $coinsCsv->getData('files/tickers.csv');

?>

<a href="/">Home</a>

<form action="transaction.php" method="post">
    <label for="coins">Select coin:</label><br>
    <select id="coins" name="coins">
        <?php
            foreach ($coins as $coin) {
                echo '<option value="' . $coin[1] . '">' . $coin[0] . '</option>';
            }
        ?>
    </select><br><br>
    <label for="value">Value:</label><br>
    <input id="value" type="number" step="0.000001" name="value"><br><br>
    <input type="submit">
</form>