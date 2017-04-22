<?php
namespace SmartPHP;

abstract class AbstractDataSourceAdapter
{

    const METHOD_FETCH = "fetch";

    const METHOD_ADD = "add";

    const METHOD_UPDATE = "update";

    const METHOD_REMOVE = "remove";

    /**
     *
     * @var object
     */
    private $instance;

    /**
     *
     * @var \ReflectionClass
     */
    private $reflectionClass;

    public function __construct($instance)
    {
        $this->instance = $instance;
        $this->reflectionClass = new \ReflectionClass($this->instance);
    }

    protected function getInstance()
    {
        return $this->instance;
    }

    protected function getReflectionClass(): \ReflectionClass
    {
        return $this->reflectionClass;
    }

    protected function hasMethod(string $name): bool
    {
        return $this->getReflectionClass()->hasMethod($name);
    }

    protected function getMethod(string $name): \ReflectionMethod
    {
        return $this->getReflectionClass()->getMethod($name);
    }

    protected function invokeMethod(string $name, array $args)
    {
        return $this->getMethod($name)->invokeArgs($this->instance, $args);
    }

    protected function hasFetchMethod(): bool
    {
        return $this->hasMethod(self::METHOD_FETCH);
    }

    protected function hasAddMethod(): bool
    {
        return $this->hasMethod(self::METHOD_ADD);
    }

    protected function hasUpdateMethod(): bool
    {
        return $this->hasMethod(self::METHOD_UPDATE);
    }

    protected function hasRemoveMethod(): bool
    {
        return $this->hasMethod(self::METHOD_REMOVE);
    }

    protected function invokeFetchMethod(int $startRow, int $endRow)
    {
        return $this->invokeMethod(self::METHOD_FETCH, [
            $startRow,
            $endRow
        ]);
    }

    protected function invokeAddMethod($object)
    {
        return $this->invokeMethod(self::METHOD_ADD, [
            $object
        ]);
    }

    protected function invokeUpdateMethod($object)
    {
        return $this->invokeMethod(self::METHOD_UPDATE, [
            $object
        ]);
    }

    protected function invokeRemoveMethod($object)
    {
        return $this->invokeMethod(self::METHOD_REMOVE, [
            $object
        ]);
    }
}
