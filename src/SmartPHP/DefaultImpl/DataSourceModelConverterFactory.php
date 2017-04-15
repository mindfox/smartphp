<?php
namespace SmartPHP\DefaultImpl;

use SmartPHP\Interfaces\DataSourceModelConverterFactoryInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use SmartPHP\Interfaces\DataSourceModelConverterInterface;

class DataSourceModelConverterFactory implements DataSourceModelConverterFactoryInterface
{

    /**
     * 
     * @var AbstractNormalizer
     */
    private $normalizer;
    
    public function __construct(AbstractNormalizer $normalizer)
    {
        $this->normalizer = $normalizer;
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceModelConvertFactoryInterface::createDataSourceModelConverter()
     */
    public function createDataSourceModelConverter(string $dataSourceModelClass): DataSourceModelConverterInterface
    {
        return new DataSourceModelConverter($this->normalizer, $dataSourceModelClass);
    }
}
