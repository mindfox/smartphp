<?php
namespace SmartPHP\DefaultImpl;

use SmartPHP\Interfaces\DataSourceInterface;
use SmartPHP\Interfaces\DataSourceModelConverterInterface;
use SmartPHP\Interfaces\DataSourceModelInterface;

class DataSource implements DataSourceInterface
{

    const METHOD_FETCH = "fetch";

    const METHOD_ADD = "add";

    const METHOD_UPDATE = "update";

    const METHOD_REMOVE = "remove";

    /**
     *
     * @var object
     */
    private $dataSourceServiceInstance;

    /**
     *
     * @var \ReflectionClass
     */
    private $dataSourceServiceReflector;

    /**
     *
     * @var \ReflectionClass
     */
    private $dataSourceServiceClass;

    /**
     *
     * @var DataSourceModelConverterInterface
     */
    private $dataSourceModelConverter;

    /**
     *
     * @var string
     */
    private $errorMsgNoFetchMethodFound;

    /**
     *
     * @var string
     */
    private $errorMsgNoAddMethodFound;

    /**
     *
     * @var string
     */
    private $errorMsgNoUpdateMethodFound;

    /**
     *
     * @var string
     */
    private $errorMsgNoRemoveMethodFound;

    public function __construct($dataSourceService, DataSourceModelConverterInterface $dataSourceModelConverter)
    {
        $this->dataSourceServiceInstance = $dataSourceService;
        $this->dataSourceServiceReflector = new \ReflectionClass($dataSourceService);
        $this->dataSourceServiceClass = $this->dataSourceServiceReflector->getName();
        $this->dataSourceModelConverter = $dataSourceModelConverter;
    }

    private function initErrorMessages()
    {
        $this->errorMsgNoFetchMethodFound = "DataSourceService '" . $this->dataSourceServiceClass . "' has not hava a method 'fetch'!";
        $this->errorMsgNoAddMethodFound = "DataSourceService '" . $this->dataSourceServiceClass . "' has not hava a method 'add'!";
        $this->errorMsgNoUpdateMethodFound = "DataSourceService '" . $this->dataSourceServiceClass . "' has not hava a method 'update'!";
        $this->errorMsgNoRemoveMethodFound = "DataSourceService '" . $this->dataSourceServiceClass . "' has not hava a method 'remove'!";
    }

    private function convertDataSourceModelToArray(DataSourceModelInterface $dataSourceModel): array
    {
        return $this->dataSourceModelConverter->toArray($dataSourceModel);
    }

    private function convertDataSourceModelsToArrays(array $dataSourceModels): array
    {
        return array_map([
            $this,
            "convertDataSourceModelToArray"
        ], $dataSourceModels);
    }

    private function convertArrayToDataSourceModel(array $array): DataSourceModelInterface
    {
        return $this->dataSourceModelConverter->toModel($array);
    }

    private function convertArraysToDataSourceModels(array $arrays): array
    {
        return array_map([
            $this,
            "convertArrayToDataSourceModel"
        ], $arrays);
    }

    private function hasMethod(string $name): bool
    {
        return $this->dataSourceServiceReflector->hasMethod($name);
    }

    private function getMethod(string $name): \ReflectionMethod
    {
        return $this->dataSourceServiceReflector->getMethod($name);
    }

    private function hasFetchMethod(): bool
    {
        return $this->hasMethod(self::METHOD_FETCH);
    }

    private function hasAddMethod(): bool
    {
        return $this->hasMethod(self::METHOD_ADD);
    }

    private function hasUpdateMethod(): bool
    {
        return $this->hasMethod(self::METHOD_UPDATE);
    }

    private function hasRemoveMethod(): bool
    {
        return $this->hasMethod(self::METHOD_REMOVE);
    }

    private function getFetchMethod(): \ReflectionMethod
    {
        return $this->getMethod(self::METHOD_FETCH);
    }

    private function getAddMethod(): \ReflectionMethod
    {
        return $this->getMethod(self::METHOD_ADD);
    }

    private function getUpdateMethod(): \ReflectionMethod
    {
        return $this->getMethod(self::METHOD_UPDATE);
    }

    private function getRemoveMethod(): \ReflectionMethod
    {
        return $this->getMethod(self::METHOD_REMOVE);
    }

    private function invokeFetchMethod(int $startRow, int $endRow): array
    {
        return $this->getFetchMethod()->invoke($this->dataSourceServiceInstance, $startRow, $endRow);
    }

    private function invokeAddMethod(array $data): array
    {
        $dataSourceModel = $this->convertArrayToDataSourceModel($data);
        $dataSourceModel = $this->getAddMethod()->invoke($this->dataSourceServiceInstance, $dataSourceModel);
        return $this->convertDataSourceModelToArray($dataSourceModel);
    }

    private function invokeUpdateMethod(array $data, array $oldValues): array
    {
        $newDataSourceModel = $this->convertArrayToDataSourceModel($data);
        $oldDataSourceModel = $this->convertArrayToDataSourceModel($oldValues);
        $dataSourceModel = $this->getAddMethod()->invoke($this->dataSourceServiceInstance, $newDataSourceModel, $oldDataSourceModel);
        return $this->convertDataSourceModelToArray($dataSourceModel);
    }

    private function invokeRemoveMethod(array $data): array
    {
        $dataSourceModel = $this->convertArrayToDataSourceModel($data);
        $dataSourceModel = $this->getAddMethod()->invoke($this->dataSourceServiceInstance, $dataSourceModel);
        return $this->convertDataSourceModelToArray($dataSourceModel);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceInterface::fetch()
     */
    public function fetch(int $startRow, int $endRow): array
    {
        if ($this->hasFetchMethod()) {
            return $this->invokeFetchMethod($startRow, $endRow);
        }
        throw new \LogicException($this->errorMsgNoFetchMethodFound);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceInterface::add()
     */
    public function add(array $data): array
    {
        if ($this->hasAddMethod()) {
            return $this->invokeAddMethod($data);
        }
        throw new \LogicException($this->errorMsgNoAddMethodFound);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceInterface::update()
     */
    public function update(array $data, array $oldValues): array
    {
        if ($this->hasUpdateMethod()) {
            return $this->invokeUpdateMethod($data, $oldValues);
        }
        throw new \LogicException($this->errorMsgNoUpdateMethodFound);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceInterface::remove()
     */
    public function remove(array $data): array
    {
        if ($this->hasRemoveMethod()) {
            return $this->invokeRemoveMethod($data);
        }
        throw new \LogicException($this->errorMsgNoRemoveMethodFound);
    }
}
