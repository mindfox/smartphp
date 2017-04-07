<?php
use DI\ContainerBuilder;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Interop\Container\ContainerInterface;
use SmartPHP\Example\DataSources\CompanyDataSource;
use SmartPHP\Example\DataSources\DepartmentDataSource;
use SmartPHP\Example\DataSources\EmployeeDataSource;
use SmartPHP\Example\Models\Entities\CompanyEntity;
use SmartPHP\Example\Models\Entities\DepartmentEntity;
use SmartPHP\Example\Models\Entities\EmployeeEntity;
use SmartPHP\Example\Repositories\CompanyRepositoryInterface;
use SmartPHP\Example\Repositories\DepartmentRepositoryInterface;
use SmartPHP\Example\Repositories\EmployeeRepositoryInterface;
use SmartPHP\Example\Services\CompanyService;
use SmartPHP\Example\Services\CompanyServiceInterface;
use SmartPHP\Example\Services\DepartmentService;
use SmartPHP\Example\Services\DepartmentServiceInterface;
use SmartPHP\Example\Services\EmployeeService;
use SmartPHP\Example\Services\EmployeeServiceInterface;
use function DI\object;
use Doctrine\ORM\EntityManagerInterface;

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
// DI Configuration

$container["DI-Definitions"] = function (ContainerInterface $container) {
    return [
        
        CompanyRepositoryInterface::class => function () use ($container) {
            return $container->get("EntityManager")->getRepository(CompanyEntity::class);
        },
        
        DepartmentRepositoryInterface::class => function () use ($container) {
            return $container->get("EntityManager")->getRepository(DepartmentEntity::class);
        },
        
        EmployeeRepositoryInterface::class => function () use ($container) {
            return $container->get("EntityManager")->getRepository(EmployeeEntity::class);
        },
        
        CompanyServiceInterface::class => object(CompanyService::class),
        
        DepartmentServiceInterface::class => object(DepartmentService::class),
        
        EmployeeServiceInterface::class => object(EmployeeService::class),
        
        CompanyDataSource::class => object(CompanyDataSource::class),
        
        DepartmentDataSource::class => object(DepartmentDataSource::class),
        
        EmployeeDataSource::class => object(EmployeeDataSource::class)
    
    ];
};

$container["DI"] = function (ContainerInterface $container) {
    $builder = new ContainerBuilder();
    $builder->addDefinitions($container->get("DI-Definitions"));
    return $builder->build();
};

// ===================================================================================
// DataSources

$container["CompanyDataSource"] = function (ContainerInterface $container) {
    return $container->get("DI")->get(CompanyDataSource::class);
};

$container["DepartmentDataSource"] = function (ContainerInterface $container) {
    return $container->get("DI")->get(DepartmentDataSource::class);
};

$container["EmployeeDataSource"] = function (ContainerInterface $container) {
    return $container->get("DI")->get(EmployeeDataSource::class);
};

