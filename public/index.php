<?php

use App\Application\Routes;
use Slim\App;

require __DIR__ . '/../vendor/autoload.php';

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];

// Create and configure Slim app
$app = new App($configuration);

// Define app routes
$routes = new Routes($app);
$routes->boardingCard();

// Run app
$app->run();