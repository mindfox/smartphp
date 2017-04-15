<?php
namespace SmartPHP\DefaultImpl;

use SmartPHP\Interfaces\DSOperationFactoryInterface;
use SmartPHP\Interfaces\DSOperationInterface;
use SmartPHP\Interfaces\DSRequestInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

class DSOperationFactory implements DSOperationFactoryInterface
{

    /**
     *
     * @var AbstractNormalizer
     */
    private $denormalizer;

    /**
     *
     * @var array
     */
    private $dsOperationDefaultValues = [];

    public function __construct(AbstractNormalizer $denormalizer)
    {
        $this->denormalizer = $denormalizer;
        $this->initDSOperationDefaultValues();
    }

    private function getPropertyValue(\ReflectionProperty $property, $instance)
    {
        $property->setAccessible(true);
        $value = $property->getValue($instance);
        $property->setAccessible(false);
        return $value;
    }

    private function initDSOperationDefaultValues()
    {
        $instance = new DSOperation();
        $reflector = new \ReflectionClass($instance);
        foreach ($reflector->getProperties() as $property) {
            $this->dsOperationDefaultValues[$property->getName()] = $this->getPropertyValue($property, $instance);
        }
    }

    private function removeNullValuesFromArray(array $array): array
    {
        return array_filter($array, function ($value) {
            return ! is_null($value);
        });
    }

    private function withDefaultValues(array $array): array
    {
        return array_merge($this->dsOperationDefaultValues, $this->removeNullValuesFromArray($array));
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceOperationFactoryInterface::createFromDSRequest()
     */
    public function createDSOperationFromDSRequest(DSRequestInterface $request): DSOperationInterface
    {
        return $this->createDSOperationFromArray($request->getData());
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceOperationFactoryInterface::createFromArray()
     */
    public function createDSOperationFromArray(array $array): DSOperationInterface
    {
        return $this->denormalizer->denormalize($this->withDefaultValues($array), DSOperation::class);
    }
}
