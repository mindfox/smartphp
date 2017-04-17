<?php
namespace SmartPHP\Example;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Setup;
use Interop\Container\ContainerInterface;
use Slim\App;
use SmartPHP\DefaultImpl\DataSource;
use SmartPHP\DI\DIBuilder;
use SmartPHP\Example\Models\DataSourceModels\CompanyDataSourceModel;
use SmartPHP\Example\Models\DataSourceModels\DepartmentDataSourceModel;
use SmartPHP\Example\Models\DataSourceModels\EmployeeDataSourceModel;
use SmartPHP\Example\Repositories\CompanyRepository;
use SmartPHP\Example\Repositories\CompanyRepositoryInterface;
use SmartPHP\Example\Repositories\DepartmentRepository;
use SmartPHP\Example\Repositories\DepartmentRepositoryInterface;
use SmartPHP\Example\Repositories\EmployeeRepository;
use SmartPHP\Example\Repositories\EmployeeRepositoryInterface;
use SmartPHP\Example\Services\CompanyService;
use SmartPHP\Example\Services\CompanyServiceInterface;
use SmartPHP\Example\Services\DepartmentService;
use SmartPHP\Example\Services\DepartmentServiceInterface;
use SmartPHP\Example\Services\EmployeeService;
use SmartPHP\Example\Services\EmployeeServiceInterface;
use SmartPHP\Interfaces\DataSourceModelConverterFactoryInterface;
use SmartPHP\Slim\AppBuilder;
use SmartPHP\Example\Handlers\DataSourceHandler;

class ExampleAppBuilder extends AppBuilder
{

    const CONFIG_DIR = __DIR__ . "/../../../config";

    protected function getSettings(): array
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
                        __DIR__ . "/Models/Entities"
                    ],
                    
                    "isDevMode" => true,
                    
                    "proxyDir" => realpath(__DIR__ . "/../../../proxies"),
                    
                    "cache" => null,
                    
                    "useSimpleAnnotationReader" => false
                
                ],
                
                "entityNamespaces" => [
                    
                    "" => "SmartPHP\Example\Models\Entities"
                
                ]
            
            ],
            
            "SmartPHP" => [
                
                "jsonPrefix" => "",
                
                "jsonSuffix" => ""
            
            ]
        
        ];
    }

    protected function configureContainer(ContainerInterface $container)
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
            $conn = $container->get("databases")["smartphp"];
            $config = $container->get("EntityManagerConfiguration");
            $entityManager = EntityManager::create($conn, $config);
            return $entityManager;
        };
    }

    protected function configureDIBuilder(DIBuilder $diBuilder, ContainerInterface $container)
    {
        $diBuilder->register(EntityManagerInterface::class, function () use ($container) {
            return $container->get("EntityManager");
        });
        
        $diBuilder->registerClassAs(CompanyRepository::class, CompanyRepositoryInterface::class);
        
        $diBuilder->registerClassAs(DepartmentRepository::class, DepartmentRepositoryInterface::class);
        
        $diBuilder->registerClassAs(EmployeeRepository::class, EmployeeRepositoryInterface::class);
        
        $diBuilder->registerClassAs(CompanyService::class, CompanyServiceInterface::class);
        
        $diBuilder->registerClassAs(DepartmentService::class, DepartmentServiceInterface::class);
        
        $diBuilder->registerClassAs(EmployeeService::class, EmployeeServiceInterface::class);
    }

    protected function configureRoutes(App $app)
    {
        $app->get("/", DataSourceHandler::class);
        $app->post("/", DataSourceHandler::class);
    }

    protected function configureMiddlewares(App $app)
    {}
}
