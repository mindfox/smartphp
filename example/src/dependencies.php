<?php
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Interop\Container\ContainerInterface;
use SmartPHP\Example\DataSources\CompanyDataSource;
use SmartPHP\Example\DataSources\DepartmentDataSource;
use SmartPHP\Example\DataSources\EmployeeDataSource;
use SmartPHP\Example\Models\Entities\CompanyEntity;
use SmartPHP\Example\Models\Entities\DepartmentEntity;
use SmartPHP\Example\Models\Entities\EmployeeEntity;
use SmartPHP\Example\Services\CompanyService;
use SmartPHP\Example\Services\DepartmentService;
use SmartPHP\Example\Services\EmployeeService;

$container = $app->getContainer();

$container["DatabaseConnection"] = function (ContainerInterface $container) {
    return [
        
        'driver' => 'pdo_mysql',
        
        'host' => '127.0.0.1',
        
        'dbname' => 'smartphp',
        
        'user' => 'root',
        
        'password' => '1234'
    
    ];
};

$container["EntityManagerConfiguration"] = function (ContainerInterface $container) {
    $paths = [
        __DIR__ . "/SmartPHP/Example/Models/Entities"
    ];
    
    $isDevMode = true;
    
    $proxyDir = __DIR__ . "/SmartPHP/Example/Models/Proxies";
    $cache = null;
    $useSimpleAnnotationReader = false;
    
    $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);
    $config->addEntityNamespace("", "SmartPHP\Example\Models\Entities");
    
    return $config;
};

$container["EntityManager"] = function (ContainerInterface $container) {
    $database = $container->get("DatabaseConnection");
    $config = $container->get("EntityManagerConfiguration");
    $entityManager = EntityManager::create($database, $config);
    return $entityManager;
};

// ===================================================================================

$container["CompanyRepository"] = function (ContainerInterface $container) {
    return $container->get("EntityManager")->getRepository(CompanyEntity::class);
};

$container["CompanyService"] = function (ContainerInterface $container) {
    return new CompanyService($container->get("CompanyRepository"));
};

$container["CompanyDataSource"] = function (ContainerInterface $container) {
    return new CompanyDataSource($container->get("CompanyService"));
};

// ===================================================================================

$container["DepartmentRepository"] = function (ContainerInterface $container) {
    return $container->get("EntityManager")->getRepository(DepartmentEntity::class);
};

$container["DepartmentService"] = function (ContainerInterface $container) {
    return new DepartmentService($container->get("DepartmentRepository"));
};

$container["DepartmentDataSource"] = function (ContainerInterface $container) {
    return new DepartmentDataSource($container->get("DepartmentService"));
};

// ===================================================================================

$container["EmployeeRepository"] = function (ContainerInterface $container) {
    return $container->get("EntityManager")->getRepository(EmployeeEntity::class);
};

$container["EmployeeService"] = function (ContainerInterface $container) {
    return new EmployeeService($container->get("EmployeeRepository"));
};

$container["EmployeeDataSource"] = function (ContainerInterface $container) {
    return new EmployeeDataSource($container->get("EmployeeService"));
};

