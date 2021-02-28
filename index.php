<?php

require_once __DIR__ . '/vendor/autoload.php';

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$container = new DI\Container();
$builder = new DI\ContainerBuilder();
$container = $builder->build();

$app = $container->get('App\MightyMaze');
$app->run();