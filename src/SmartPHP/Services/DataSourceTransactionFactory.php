<?php
namespace SmartPHP\Services;

use SmartPHP\Interfaces\DataSourceTransactionFactoryInterface;
use SmartPHP\Interfaces\DataSourceRequestInterface;
use SmartPHP\Interfaces\DataSourceTransactionInterface;
use SmartPHP\Interfaces\DataSourceOperationFactoryInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use SmartPHP\Models\DataSourceTransaction;

class DataSourceTransactionFactory implements DataSourceTransactionFactoryInterface
{

    /**
     *
     * @var DataSourceOperationFactoryInterface
     */
    private $dsOperationFactory;

    /**
     *
     * @var DenormalizerInterface
     */
    private $denormalizer;

    public function __construct(DataSourceOperationFactoryInterface $dsOperationFactory, DenormalizerInterface $denormalizer)
    {
        $this->dsOperationFactory = $dsOperationFactory;
        $this->denormalizer = $denormalizer;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceTransactionFactoryInterface::createFromDSRequest()
     */
    public function createFromDSRequest(DataSourceRequestInterface $dsRequest): DataSourceTransactionInterface
    {
        return $this->createFromArray($dsRequest->getData());
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceTransactionFactoryInterface::createFromArray()
     */
    public function createFromArray(array $array): DataSourceTransactionInterface
    {
        /**
         *
         * @var DataSourceTransaction $transaction
         */
        $transaction = $this->denormalizer->denormalize($array, DataSourceTransaction::class);
        
        $operations = $array["operations"] ?? [];
        
        foreach ($operations as $array) {
            $array["dataFormat"] = $transaction->getDataFormat();
            $transaction->addOperation($this->dsOperationFactory->createFromArray($array));
        }
        
        return $transaction;
    }
}