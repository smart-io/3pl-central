#!/usr/bin/php
<?php

require_once 'vendor/autoload.php';

use Symfony\Component\Console\Application;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Console\Helper\HelperSet;
use Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Doctrine\DBAL\Migrations\Configuration\Configuration;

$paths = ['/src'];
$isDevMode = false;

$dbParams = [
    'driver'   => 'pdo_mysql',
    'user'     => '3pl_central',
    'password' => 'password',
    'dbname'   => '3pl_central',
];

$console = new Application();
$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);
$db = new ConnectionHelper($entityManager->getConnection());

$helperSet = new HelperSet([
    'db' => $db,
    'em' => new EntityManagerHelper($entityManager)
]);

ConsoleRunner::addCommands($console);

$migrationsConfig = new Configuration($entityManager->getConnection());
$migrationsConfig->setName('DBAL Migrations');
$migrationsConfig->setMigrationsNamespace('Migrations');
$migrationsConfig->setMigrationsTableName('migration_versions');
$migrationsConfig->setMigrationsDirectory('migrations');
$migrationsConfig->registerMigrationsFromDirectory('migrations');

$diffCommand = new \Doctrine\DBAL\Migrations\Tools\Console\Command\DiffCommand();
$diffCommand->setMigrationConfiguration($migrationsConfig);
$executeCommand = new \Doctrine\DBAL\Migrations\Tools\Console\Command\ExecuteCommand();
$executeCommand->setMigrationConfiguration($migrationsConfig);
$generateCommand = new \Doctrine\DBAL\Migrations\Tools\Console\Command\GenerateCommand();
$generateCommand->setMigrationConfiguration($migrationsConfig);
$migrateCommand = new \Doctrine\DBAL\Migrations\Tools\Console\Command\MigrateCommand();
$migrateCommand->setMigrationConfiguration($migrationsConfig);
$statusCommand = new \Doctrine\DBAL\Migrations\Tools\Console\Command\StatusCommand();
$statusCommand->setMigrationConfiguration($migrationsConfig);
$versionCommand = new \Doctrine\DBAL\Migrations\Tools\Console\Command\VersionCommand();
$versionCommand->setMigrationConfiguration($migrationsConfig);

$console->addCommands([
    $diffCommand,
    $executeCommand,
    $generateCommand,
    $migrateCommand,
    $statusCommand,
    $versionCommand,
]);

$console->setHelperSet($helperSet);
$console->run();
