<?php
namespace intrawarez\slimsmartclient;

use Psr\Http\Message\ServerRequestInterface;
use Interop\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;

abstract class RestDataSourceBackend {
    
    public static function DSRequest(ServerRequestInterface $request): DSRequest
    {
        $dsRequest = new DSRequest();
        $parsedBody = $request->getParsedBody();
        
        $componentId = strval(@$parsedBody["componentId"]);
        $dataSource = strval(@$parsedBody["dataSource"]);
        $operationType = strval(@$parsedBody["operationType"]);
        $textMatchStyle = strval(@$parsedBody["textMatchStyle"]);
        
        $dsRequest->setComponentId($componentId);
        $dsRequest->setDataSource($dataSource);
        $dsRequest->setOperationType($operationType);
        $dsRequest->setTextMatchStyle($textMatchStyle);
        
        return $dsRequest;
    }
    
    private $container;
    
    public function __construct (ContainerInterface $container) {
        $this->container = $container;
    }
    
    final public function hasDataSource(string $dataSourceId): DataSourceInterface
    {
        return $this->container->has($dataSourceId) && $this->container->get($id) instanceof DataSourceInterface;
    }

    final public function getDataSource(string $dataSourceId): DataSourceInterface
    {
        return $this->container->get($dataSourceId);
    }
    
    public function execute(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $dsRequest = self::DSRequest($request);
        
        $dataSourceId = $dsRequest->getDataSource();
        
        if ($this->hasDataSource($dataSourceId)) {
            
            $dataSource = $this->getDataSource($dataSourceId);
            
            switch ($dsRequest->getOperationType()) {
                
                case DSOperationType::FETCH:
                    $dsResponse = $dataSource->fetch($dsRequest);
                    break;
                    
                default:
                    throw new \Exception("Unknown operation type: '{$dsRequest->getOperationType()}'");
                
            }
            
            $response->getBody()->
            
        }
        
    }
    
}
