<?php
namespace ThreePlCentral;

use DI\Container;

class App
{
    public function __invoke(Container $container)
    {
        //$container->set('router', $router);
        //$container->call('ThreePlCentral\Router');
        //$router->run();

        $app = new \Slim\App();

        $app->get('/hello/{name}', function ($request, $response, $args) {
            $response->write("Hello, " . $args['name']);
            return $response;
        });

        $app->run();
    }
}
