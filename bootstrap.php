<?php
use Slim\App;

require __DIR__ . '/vendor/autoload.php';

$app = new App();

// Get dependencies
$dependencies = require __DIR__ . '/example/src/dependencies.php';


/**
 *
 * @var Doctrine\ORM\EntityManager $entityManager
 */
$entityManager = $container->get("EntityManager");

