<?php
namespace maxmeffert\smartphp;

use Symfony\Component\Serializer\SerializerInterface;
use Psr\Http\Message\ServerRequestInterface;

class DataSourceRequest extends AbstractServerRequestInterfaceAdapter
{

    /**
     *
     * @var SerializerInterface
     */
    private $serializer;

    /**
     *
     * @var DataSourceMessageInterface
     */
    private $message;

    public function __construct(ServerRequestInterface $psrServerRequest, SerializerInterface $serializer)
    {
        parent::__construct($psrServerRequest);
        $this->serializer = $serializer;
    }

    private function createDataSourceMessage(ServerRequestInterface $psrServerRequest): DataSourceMessageInterface
    {
        $parsedBody = $psrServerRequest->getParsedBody();
        return (new DataSourceMessage())
            ->withComponentId(@$parsedBody["componentId"] ?? "")
            ->withDataSource(@$parsedBody["dataSource"] ?? "")
            ->withOperationType(@$parsedBody["operationType"] ?? "")
            ->withStartRow(@$parsedBody["startRow"] ?? 0)
            ->withEndRow(@$parsedBody["endRow"] ?? 0)
            ->withTextMatchStyle(@$parsedBody["textMatchStyle"] ?? "")
            ->withData(@$parsedBody["data"] ?? []);
    }

    protected function createImmutable(ServerRequestInterface $psrServerRequest): ServerRequestInterface
    {
        return new self($psrServerRequest, $this->serializer);
    }
}