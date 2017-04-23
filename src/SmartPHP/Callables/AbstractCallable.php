<?php
namespace SmartPHP\Callables;

class AbstractCallable implements CallableInterface
{

    private $callable;

    public function __construct(callable $callable)
    {
        $this->callable = $callable instanceof CallableInterface ? $callable->getCallable() : $callable;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Callables\CallableInterface::getCallable()
     */
    public function getCallable(): callable
    {
        return $this->callable;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Callables\CallableInterface::call()
     */
    public function call()
    {
        return $this->callArgs(func_get_args());
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Callables\CallableInterface::callArgs()
     */
    public function callArgs(array $args)
    {
        return call_user_func_array($this->callable, $args);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Callables\CallableInterface::__invoke()
     */
    public function __invoke()
    {
        return $this->callArgs(func_get_args());
    }
}
