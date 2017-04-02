<?php
use SmartPHP\Slim\DataSourceController;

// Routes


$app->get("/", DataSourceController::class);
$app->post("/", DataSourceController::class);
