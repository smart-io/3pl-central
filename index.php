<?php

require_once 'vendor/autoload.php';

$app = new \Slim\App();

$app->get('/hello/{name}', function ($request, $response, $args) {
    $response->write("Hello, " . $args['name']);
    return $response;
});

$app->run();

/*
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use DI\ContainerBuilder;

$dbParams = [
    'driver'   => 'pdo_mysql',
    'user'     => '3pl_central',
    'password' => 'password',
    'dbname'   => '3pl_central',
];

$container = ContainerBuilder::buildDevContainer();

$paths = [__DIR__ . '/src'];
$isDevMode = false;

$dbParams = [
    'driver'   => 'pdo_mysql',
    'user'     => '3pl_central',
    'password' => 'password',
    'dbname'   => '3pl_central',
];

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);
$container->set('em', $entityManager);

if (basename($_SERVER['SCRIPT_FILENAME']) === basename(__FILE__)) {
    $container->call('ThreePlCentral\App');
}

return $container;
*/