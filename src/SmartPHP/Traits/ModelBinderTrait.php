<?php
namespace SmartPHP\Traits;

use SmartPHP\Interfaces\DataSourceOperationInterface;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

trait ModelBinderTrait
{

    public function bind(array $data, string $class)
    {
        $normalizer = new GetSetMethodNormalizer();
        return $normalizer->denormalize($data, $class);
    }
    
    public function bindMerged(array $newData, array $oldData, string $class)
    {
        $data = array_merge($oldData, $newData);
        return $this->bind($data, $class);
    }
    
    public function bindOperation(DataSourceOperationInterface $operation, string $class)
    {
        return $this->bindMerged($operation->getData(), $operation->getOldValues(), $class);
    }
}