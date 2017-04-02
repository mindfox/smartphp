<?php
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Interop\Container\ContainerInterface;
use SmartPHP\Example\DataSources\CompanyDataSource;
use SmartPHP\Example\Models\Entities\CompanyEntity;
use SmartPHP\Example\Services\CompanyService;

$container = $app->getContainer();

$container["EntityManager"] = function (ContainerInterface $container) {
    
    $database = [
        
        'driver' => 'pdo_mysql',
        
        'host' => '127.0.0.1',
        
        'dbname' => 'smartphp',
        
        'user' => 'root',
        
        'password' => '1234'
    
    ];
    
    $paths = [
        __DIR__ . "/SmartPHP/Example/Models/Entities"
    ];
    
    // var_dump(file_exists($paths[0])); die();
    
    $isDevMode = true;
    
    $proxyDir = __DIR__ . "/SmartPHP/Example/Models/Proxies";
    $cache = null;
    $useSimpleAnnotationReader = false;
    
    $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);
    $config->addEntityNamespace("", "SmartPHP\Example\Models\Entities");
    
    // var_dump($database); die();
    
    $entityManager = EntityManager::create($database, $config);
    
    return $entityManager;
};

$container["CompanyRepository"] = function (ContainerInterface $container) {
    return $container->get("EntityManager")->getRepository(CompanyEntity::class);
};

$container["CompanyService"] = function (ContainerInterface $container) {
    return new CompanyService($container->get("CompanyRepository"));
};

$container["CompanyDS"] = function (ContainerInterface $container) {
    return new CompanyDataSource($container->get("CompanyService"));
};

