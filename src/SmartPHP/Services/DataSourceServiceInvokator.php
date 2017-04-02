<?php
namespace SmartPHP\Services;

use SmartPHP\Interfaces\DataSourceServiceInvokatorInterface;
use SmartPHP\Interfaces\DataSourceServiceInterface;
use SmartPHP\Interfaces\DataSourceMessageInterface;
use SmartPHP\Models\DataSourceOperationType;

class DataSourceServiceInvokator implements DataSourceServiceInvokatorInterface
{

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\DataSourceServiceInvokatorInterface::invokeService()
     */
    public function invokeService(DataSourceServiceInterface $service, DataSourceMessageInterface $message): DataSourceMessageInterface
    {
        switch(strtolower($message->getOperationType())) {
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