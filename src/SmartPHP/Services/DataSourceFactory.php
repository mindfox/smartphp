<?php
namespace SmartPHP\Services;

use Interop\Container\ContainerInterface;
use SmartPHP\Interfaces\DataSourceFactoryInterface;
use SmartPHP\Interfaces\DataSourceMessageInterface;
use SmartPHP\Interfaces\DataSourceInterface;

class DataSourceFactory implements DataSourceFactoryInterface
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
    public function createFromDataSourceMessage(DataSourceMessageInterface $message): DataSourceInterface
    {
        $id = trim($message->getDataSource());
        return $this->container->get($id);
    }
}