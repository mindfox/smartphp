<?php
namespace SmartPHP\Services;

use SmartPHP\Interfaces\DataSourceOperationFactoryInterface;
use SmartPHP\Interfaces\DataSourceOperationInterface;
use SmartPHP\Interfaces\DataSourceRequestInterface;
use SmartPHP\Models\DataSourceOperation;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

class DataSourceOperationFactory implements DataSourceOperationFactoryInterface
{

    /**
     *
     * @var AbstractNormalizer
     */
    private $denormalizer;

    public function __construct(AbstractNormalizer $denormalizer)
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
//         var_dump($array); die();
//         $default = $this->denormalizer->normalize(new DataSourceOperation());
//         $array = array_merge($default, $array);
        return $this->denormalizer->denormalize($array, DataSourceOperation::class);
    }
}