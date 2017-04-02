<?php
namespace SmartPHP\Services;

use Psr\Http\Message\ServerRequestInterface;
use SmartPHP\Interfaces\DataSourceMessageFactoryInterface;
use SmartPHP\Interfaces\DataSourceMessageInterface;
use SmartPHP\Models\DataSourceMessage;

class DataSourceMessageFactory implements DataSourceMessageFactoryInterface
{

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\DataSourceMessageFactoryInterface::createFromArray()
     */
    public function createFromArray(array $array): DataSourceMessageInterface
    {
        $message = new DataSourceMessage();
        $message->setDataSource(@$array["dataSource"]);
        $message->setOperationType(@$array["operationType"]);
        $message->setDataFormat(@$array["isc_dataFormat"]);
        
        return $message;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\DataSourceMessageFactory::createFromServerRequestInterface()
     */
    public function createFromServerRequest(ServerRequestInterface $request): DataSourceMessageInterface
    {
        $array = array_merge($request->getParsedBody(), $request->getQueryParams());
        return $this->createFromArray($array);
    }
}