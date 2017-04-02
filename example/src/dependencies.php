<?php
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Setup;
use Interop\Container\ContainerInterface;
use SmartPHP\Example\DataSources\CompanyDataSource;
use SmartPHP\Example\Models\Entities\CompanyEntity;
use SmartPHP\Services\DataSourceFactory;
use SmartPHP\Services\DataSourceInvokator;
use SmartPHP\Services\DataSourceMessageFactory;
use SmartPHP\Services\DataSourceMessageSerializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;
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

$container["Serializer"] = function (ContainerInterface $c) {
    $encoders = [
        new JsonEncoder()
    ];
    
    $normalizers = [
        new GetSetMethodNormalizer()
    ];
    
    $serializer = new Serializer($normalizers, $encoders);
    
    return $serializer;
};

$container["SmartPHP/Serializer"] = function (ContainerInterface $c) {
    $serializer = $c->get("Serializer");
    return new DataSourceMessageSerializer($serializer);
};

$container["SmartPHP/MessageFactory"] = function (ContainerInterface $c) {
    return new DataSourceMessageFactory();
};

$container["SmartPHP/ServiceFactory"] = function (ContainerInterface $c) {
    return new DataSourceFactory($c);
};

$container["SmartPHP/ServiceInvokator"] = function (ContainerInterface $c) {
    return new DataSourceInvokator();
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

