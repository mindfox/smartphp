<?php
namespace SmartPHP\Services;

use SmartPHP\Interfaces\DataSourceInvokatorInterface;
use SmartPHP\Interfaces\DataSourceInterface;
use SmartPHP\Interfaces\DataSourceMessageInterface;
use SmartPHP\Models\DataSourceOperationType;

class DataSourceInvokator implements DataSourceInvokatorInterface
{

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\DataSourceServiceInvokatorInterface::invokeService()
     */
    public function invokeDataSource(DataSourceInterface $service, DataSourceMessageInterface $message): DataSourceMessageInterface
    {
        switch (strtolower($message->getOperationType())) {
            case DataSourceOperationType::FETCH:
                return $service->fetch($message);
            case DataSourceOperationType::ADD:
                return $service->add($message);
            case DataSourceOperationType::UPDATE:
                return $service->update($message);
            case DataSourceOperationType::REMOVE:
                return $service->remove($message);
        }
        
        throw new \Exception("Unknown OperationType!");
    }
}