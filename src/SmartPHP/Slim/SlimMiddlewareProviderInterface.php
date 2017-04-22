<?php
namespace SmartPHP\Slim;

use Slim\App;

interface SlimMiddlewareProviderInterface
{

    public function configureMiddlewares(App $app);
}
