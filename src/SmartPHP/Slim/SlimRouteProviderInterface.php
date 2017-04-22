<?php
namespace SmartPHP\Slim;

use Slim\App;

interface SlimRouteProviderInterface
{

    public function configureRoutes(App $app);
}
