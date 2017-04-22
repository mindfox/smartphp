<?php
use SmartPHP\Example\Slim\ExampleAppBuilder;

require __DIR__ . '/vendor/autoload.php';

$app = ExampleAppBuilder::create()->build();

/**
 *
 * @var Doctrine\ORM\EntityManager $entityManager
 */
$entityManager = $app->getContainer()->get("EntityManager");

