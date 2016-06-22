<?php
namespace ThreePlCentral;

use Slim\App as SlimRouter;

class Router
{
    public function __invoke(SlimRouter $app)
    {
        $app->get('/hello', function ($request, $response) {
            $response->write("Hello");
            return $response;
        });
    }
}
