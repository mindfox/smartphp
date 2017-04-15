<?php
namespace SmartPHP\DefaultImpl;

use SmartPHP\Interfaces\DataSourceModelConverterInterface;
use SmartPHP\Interfaces\DataSourceModelInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

class DataSourceModelConverter implements DataSourceModelConverterInterface
{

    /**
     *
     * @var AbstractNormalizer
     */
    private $normalizer;

    /**
     *
     * @var string
     */
    private $dataSourceModelClass;

    public function __construct(AbstractNormalizer $normalizer, string $dataSourceModelClass)
    {
        $this->normalizer = $normalizer;
        $this->dataSourceModelClass = $dataSourceModelClass;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceModelConverterInterface::toArray()
     */
    public function toArray(DataSourceModelInterface $dataSourceModel): array
    {
        return $this->normalizer->normalize($dataSourceModel);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceModelConverterInterface::toModel()
     */
    public function toModel(array $array): DataSourceModelInterface
    {
        return $this->normalizer->denormalize($array, $this->dataSourceModelClass);
    }
}
