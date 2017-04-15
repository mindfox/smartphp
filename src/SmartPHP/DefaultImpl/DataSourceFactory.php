<?php
namespace SmartPHP\DefaultImpl;

use Interop\Container\ContainerInterface;
use SmartPHP\Interfaces\DataSourceFactoryInterface;
use SmartPHP\Interfaces\DSOperationInterface;
use SmartPHP\Interfaces\DataSourceInterface;
use SmartPHP\Interfaces\DataSourceModelConverterFactoryInterface;
use SmartPHP\Interfaces\DataSourceModelConverterInterface;

class DataSourceFactory implements DataSourceFactoryInterface
{

    private $registry = [];
    
    /**
     *
     * @var ContainerInterface
     */
    private $container;
    
    /**
     *
     * @var DataSourceModelConverterFactoryInterface
     */
    private $dataSourceModelConverter;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->dataSourceModelConverter = $container->get(DataSourceModelConverterFactoryInterface::class);
    }
    
    private function has(string $id): bool
    {
        return isset($this->registry[$id]);
    }
    
    private function getServiceClassName(string $id): string
    {
        return $this->registry[$id]["service"];
    }
    
    private function getModelClassName(string $id): string
    {
        return $this->registry[$id]["model"];
    }
    
    private function getService(string $id)
    {
        return $this->container->get($this->getServiceClassName($id));
    }
        
    private function getModelConverter(string $id): DataSourceModelConverterInterface
    {
        return $this->dataSourceModelConverter->createDataSourceModelConverter($this->getModelClassName($id));
    }
    
    public function register(string $id, string $dataSoruceServiceClass, string $dataSourceModelClass)
    {
        $this->registry[$id] = [
            
            "service" => $dataSoruceServiceClass,
            
            "model" => $dataSourceModelClass
            
        ];
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceFactoryInterface::createDataSourceFromId($id)
     */
    public function createDataSourceFromId(string $id): DataSourceInterface
    {
        $dataSourceService = $this->getService($id);
        $dataSourceModelConverter = $this->getModelConverter($id);
        return new DataSource($dataSourceService, $dataSourceModelConverter);
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceFactoryInterface::createDataSourceFromOperation()
     */
    public function createDataSourceFromOperation(DSOperationInterface $dsOperation): DataSourceInterface
    {
        $id = trim($dsOperation->getDataSource());
        return $this->createDataSourceFromId($id);
    }
}
