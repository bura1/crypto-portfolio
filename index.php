<?php

use Service\Container;

require __DIR__.'/bootstrap.php';

$container = new Container($dbConfiguration);

$portfolio = $container->getPortfolio($nomicsApiKey, 'USD');

dd($portfolio);

