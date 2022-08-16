<?php

use Service\Container;

require __DIR__.'/bootstrap.php';

$container = new Container($configuration);

$portfolio = $container->getPortfolio();

dd($portfolio);