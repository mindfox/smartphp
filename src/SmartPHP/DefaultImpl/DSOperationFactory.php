<?php
namespace SmartPHP\DefaultImpl;

use SmartPHP\Interfaces\DSOperationFactoryInterface;
use SmartPHP\Interfaces\DSOperationInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use SmartPHP\Interfaces\DSRequestInterface;

class DSOperationFactory implements DSOperationFactoryInterface
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
        // var_dump($array); die();
        // $default = $this->denormalizer->normalize(new DataSourceOperation());
        // $array = array_merge($default, $array);
        return $this->denormalizer->denormalize($array, DSOperation::class);
    }
}
