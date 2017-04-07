<?php
namespace SmartPHP\Example;

use SmartPHP\Slim\AppBuilder;
use Interop\Container\ContainerInterface;
use DI\ContainerBuilder;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
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
use SmartPHP\Slim\DataSourceController;
use Slim\App;

class ExampleAppBuilder extends AppBuilder
{

    const CONFIG_DIR = __DIR__ . "/../../../config";

    protected function createSettings(): array
    {
        return [
            
            "settings" => [
                
                "displayErrorDetails" => true, // set to false in production
                
                "addContentLengthHeader" => false // Allow the web server to send the content-length header
            
            ],
            
            "databases" => require self::CONFIG_DIR . "/databases.php",
            
            "doctrine" => [
                
                "annotationMetadataConfiguration" => [
                    
                    "paths" => [
                        __DIR__ . "/SmartPHP/Example/Models/Entities"
                    ],
                    
                    "isDevMode" => true,
                    
                    "proxyDir" => __DIR__ . "/SmartPHP/Example/Models/Proxies",
                    
                    "cache" => null,
                    
                    "useSimpleAnnotationReader" => false
                
                ],
                
                "entityNamespaces" => [
                    
                    "" => "SmartPHP\Example\Models\Entities"
                
                ]
            
            ]
        
        ];
    }
    
    protected function registerDependencies(ContainerInterface $container): AppBuilder
    {
        $container["EntityManagerConfiguration"] = function (ContainerInterface $container) {
            $settings = $container->get("doctrine")["annotationMetadataConfiguration"];
            $entityNamespaces = $container->get("doctrine")["entityNamespaces"];
            $config = Setup::createAnnotationMetadataConfiguration($settings["paths"], $settings["isDevMode"], $settings["proxyDir"], $settings["cache"], $settings["useSimpleAnnotationReader"]);
            foreach ($entityNamespaces as $alias => $namespace) {
                $config->addEntityNamespace($alias, $namespace);
            }
            return $config;
        };
        
        $container["EntityManager"] = function (ContainerInterface $container) {
            $database = $container->get("databases")["smartphp"];
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
        
//         var_dump($container); die();
        
        return parent::registerDependencies($container);
    }

    protected function registerRoutes(App $app): AppBuilder
    {
        $app->get("/", DataSourceController::class);
        $app->post("/", DataSourceController::class);
        
        return parent::registerRoutes($app);
    }

}