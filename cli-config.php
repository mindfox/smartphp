<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;

$entityManager = null;

require_once __DIR__ . '/bootstrap.php';

return ConsoleRunner::createHelperSet($entityManager);
