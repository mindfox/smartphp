<?php
namespace SmartPHP\DefaultImpl;

use SmartPHP\DefaultImpl\DSTransaction;
use SmartPHP\Interfaces\DSOperationFactoryInterface;
use SmartPHP\Interfaces\DSRequestInterface;
use SmartPHP\Interfaces\DSTransactionFactoryInterface;
use SmartPHP\Interfaces\DSTransactionInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class DSTransactionFactory implements DSTransactionFactoryInterface
{

    /**
     *
     * @var DSOperationFactoryInterface
     */
    private $dsOperationFactory;

    /**
     *
     * @var DenormalizerInterface
     */
    private $denormalizer;

    public function __construct(DSOperationFactoryInterface $dsOperationFactory, DenormalizerInterface $denormalizer)
    {
        $this->dsOperationFactory = $dsOperationFactory;
        $this->denormalizer = $denormalizer;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceTransactionFactoryInterface::createDSTransactionFromDSRequest()
     */
    public function createDSTransactionFromDSRequest(DSRequestInterface $dsRequest): DSTransactionInterface
    {
        return $this->createDSTransactionFromArray($dsRequest->getData());
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceTransactionFactoryInterface::createDSTransactionFromArray()
     */
    public function createDSTransactionFromArray(array $array): DSTransactionInterface
    {
        /**
         *
         * @var DataSourceTransaction $transaction
         */
        $transaction = $this->denormalizer->denormalize($array, DSTransaction::class);
        
        $operations = $array["operations"] ?? [];
        
        foreach ($operations as $array) {
            $array["dataFormat"] = $transaction->getDataFormat();
            $transaction->addOperation($this->dsOperationFactory->createDSOperationFromArray($array));
        }
        
        return $transaction;
    }
}
