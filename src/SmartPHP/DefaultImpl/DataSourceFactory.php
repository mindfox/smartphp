<?php
namespace SmartPHP\DefaultImpl;

use Interop\Container\ContainerInterface;
use SmartPHP\Interfaces\DataSourceFactoryInterface;
use SmartPHP\Interfaces\DSOperationInterface;

class DataSourceFactory implements DataSourceFactoryInterface
{

    /**
     *
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceFactoryInterface::createDataSourceFromOperation()
     */
    public function createDataSourceFromOperation(DSOperationInterface $dsOperation)
    {
        $id = trim($dsOperation->getDataSource());
        return $this->container->get($id);
    }
}
