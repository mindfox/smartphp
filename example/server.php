<?php
use Slim\App;
use SmartPHP\Slim\DataSourceController;

include_once '../vendor/autoload.php';
include_once "./Country.php";
include_once "./CountryService.php";

$c = require './container.php';

$app = new App($c);

$app->get("/", DataSourceController::class);
$app->post("/", DataSourceController::class);

$app->run();
