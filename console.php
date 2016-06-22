#!/usr/bin/php
<?php

require_once 'vendor/autoload.php';

use Symfony\Component\Console\Application;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Symfony\Component\Console\Helper\HelperSet;
use Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Doctrine\DBAL\Migrations\Configuration\Configuration;
use Symfony\Component\Console\Helper\QuestionHelper;

$console = new Application();
$container = require "index.php";

$db = new ConnectionHelper($container->get('em')->getConnection());

$helperSet = new HelperSet([
    'db' => $db,
    'em' => new EntityManagerHelper($container->get('em')),
    'dialog' => new QuestionHelper()
]);

$console->setHelperSet($helperSet);

ConsoleRunner::addCommands($console);

$migrationsConfig = new Configuration($container->get('em')->getConnection());
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

$console->run();
