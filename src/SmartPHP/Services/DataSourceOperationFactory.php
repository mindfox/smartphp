<?php
namespace SmartPHP\Services;

use SmartPHP\Interfaces\DataSourceOperationFactoryInterface;
use SmartPHP\Interfaces\DataSourceOperationInterface;
use SmartPHP\Interfaces\DataSourceRequestInterface;
use SmartPHP\Models\DataSourceOperation;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class DataSourceOperationFactory implements DataSourceOperationFactoryInterface
{

    /**
     *
     * @var DenormalizerInterface
     */
    private $denormalizer;

    public function __construct(DenormalizerInterface $denormalizer)
    {
        $this->denormalizer = $denormalizer;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceOperationFactoryInterface::createFromDSRequest()
     */
    public function createFromDSRequest(DataSourceRequestInterface $request): DataSourceOperationInterface
    {
        return $this->createFromArray($request->getData());
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceOperationFactoryInterface::createFromArray()
     */
    public function createFromArray(array $array): DataSourceOperationInterface
    {
        return $this->denormalizer->denormalize($array, DataSourceOperation::class);
    }
}