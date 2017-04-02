<?php
namespace SmartPHP\Services;

use Interop\Container\ContainerInterface;
use SmartPHP\Interfaces\DataSourceServiceFactoryInterface;
use SmartPHP\Interfaces\DataSourceMessageInterface;
use SmartPHP\Interfaces\DataSourceServiceInterface;

class DataSourceServiceFactory implements DataSourceServiceFactoryInterface
{

    /**
     * 
     * @var ContainerInterface
     */
    private $container;
    
    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\DataSourceServiceFactoryInterface::createFromDataSourceMessage()
     */
    public function createFromDataSourceMessage(DataSourceMessageInterface $message): DataSourceServiceInterface
    {
        $id = trim($message->getDataSource());
        return $this->container->get($id);
    }
}