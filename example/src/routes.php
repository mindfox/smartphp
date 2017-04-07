<?php
use SmartPHP\Slim\DataSourceController;
use SmartPHP\Example\Services\CompanyServiceInterface;
use function DI\object;

// Routes


$app->get("/", DataSourceController::class);
$app->post("/", DataSourceController::class);





$app->get("/foo", function() {
    var_dump(object(Foo::class));
});