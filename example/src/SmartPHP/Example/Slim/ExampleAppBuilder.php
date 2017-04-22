<?php
namespace SmartPHP\Example\Slim;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Interop\Container\ContainerInterface;
use Slim\App;
use SmartPHP\DI\DIDefinitionBuilderInterface;
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
use SmartPHP\Example\Slim\Controllers\DataSourceController;
use SmartPHP\Slim\SlimAppBuilder;

class ExampleAppBuilder extends SlimAppBuilder
{

    const APP_DIR = __DIR__ . "/../../../..";

    const CONFIG_DIR = self::APP_DIR . "/config";

    const PROXY_DIR = self::APP_DIR . "/proxies";

    const PUBLIC_DIR = self::APP_DIR . "/public";

    const SRC_DIR = self::APP_DIR . "/src";

    const DATABASES = self::CONFIG_DIR . "/databases.php";

    public function getConfig(): array
    {
        return [
            
            "settings.displayErrorDetails" => true, // set to false in production
            
            "settings.addContentLengthHeader" => false, // Allow the web server to send the content-length header
            
            "databases" => require self::DATABASES,
            
            "doctrine.annotationMetadataConfiguration.paths" => [
                realpath(self::SRC_DIR . "/SmartPHP/Example/Models/Entities")
            ],
            
            "doctrine.annotationMetadataConfiguration.isDevMode" => true,
            "doctrine.annotationMetadataConfiguration.proxyDir" => realpath(self::PROXY_DIR),
            "doctrine.annotationMetadataConfiguration.cache" => null,
            "doctrine.annotationMetadataConfiguration.useSimpleAnnotationReader" => false,
            "doctrine.entityNamespaces" => [
                "" => "SmartPHP\Example\Models\Entities"
            ],
            
            "SmartPHP.jsonPrefix" => "",
            "SmartPHP.jsonSuffix" => ""
        
        ];
    }

    public function configureDIDefinitions(DIDefinitionBuilderInterface $diDefinitionBuilder)
    {
        $diDefinitionBuilder->register("EntityManagerConfiguration", function (ContainerInterface $container) {
            $paths = $container->get("doctrine.annotationMetadataConfiguration.paths");
            $isDevMode = $container->get("doctrine.annotationMetadataConfiguration.isDevMode");
            $poxyDir = $container->get("doctrine.annotationMetadataConfiguration.proxyDir");
            $cache = $container->get("doctrine.annotationMetadataConfiguration.cache");
            $useSimpleAnnotationReader = $container->get("doctrine.annotationMetadataConfiguration.useSimpleAnnotationReader");
            $entityNamespaces = $container->get("doctrine.entityNamespaces");
            $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, $poxyDir, $cache, $useSimpleAnnotationReader);
            foreach ($entityNamespaces as $alias => $namespace) {
                $config->addEntityNamespace($alias, $namespace);
            }
            return $config;
        });
        
        $diDefinitionBuilder->register("EntityManager", function (ContainerInterface $container) {
            $databaseConnections = $container->get("databases");
            $conn = $databaseConnections["smartphp"];
            $config = $container->get("EntityManagerConfiguration");
            $entityManager = EntityManager::create($conn, $config);
            return $entityManager;
        });
        
        $diDefinitionBuilder->register(CompanyRepositoryInterface::class, function (ContainerInterface $container) {
            return $container->get("EntityManager")
                ->getRepository(CompanyEntity::class);
        });
        
        $diDefinitionBuilder->register(DepartmentRepositoryInterface::class, function (ContainerInterface $container) {
            return $container->get("EntityManager")
                ->getRepository(DepartmentEntity::class);
        });
        
        $diDefinitionBuilder->register(EmployeeRepositoryInterface::class, function (ContainerInterface $container) {
            return $container->get("EntityManager")
                ->getRepository(EmployeeEntity::class);
        });
        
        $diDefinitionBuilder->registerClassAs(CompanyService::class, CompanyServiceInterface::class);
        
        $diDefinitionBuilder->registerClassAs(DepartmentService::class, DepartmentServiceInterface::class);
        
        $diDefinitionBuilder->registerClassAs(EmployeeService::class, EmployeeServiceInterface::class);
    }

    public function configureRoutes(App $app)
    {
        $app->get("/", DataSourceController::class);
        $app->post("/", DataSourceController::class);
    }
}
