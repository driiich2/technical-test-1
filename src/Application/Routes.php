<?php

namespace App\Application;

use App\Application\Actions\BoardingCardController;
use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

class Routes
{

    private App $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    public function boardingCard()
    {
        $this->app->post('/api/convert', function (Request $request, Response $response) {
            return BoardingCardController::convert($request, $response);
        });
    }
}