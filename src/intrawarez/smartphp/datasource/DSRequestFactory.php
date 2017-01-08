<?php
namespace intrawarez\smartphp\datasource;

use Psr\Http\Message\ServerRequestInterface;

final class DSRequestFactory
{
    
    public function fromServerRequestInterface(ServerRequestInterface $request): DSRequest
    {
        $dsRequest = new DSRequest();
        $parsedBody = $request->getParsedBody();
        
        $componentId = strval(@$parsedBody["componentId"]);
        $dataSource = strval(@$parsedBody["dataSource"]);
        $operationType = strval(@$parsedBody["operationType"]);
        $textMatchStyle = strval(@$parsedBody["textMatchStyle"]);
        $data = isset($parsedBody["data"]) ? $parsedBody["data"] : [];
        $oldValues = isset($parsedBody["oldValues"]) ? $parsedBody["oldValues"] : [];
        
        $dsRequest->setComponentId($componentId);
        $dsRequest->setDataSource($dataSource);
        $dsRequest->setOperationType($operationType);
        $dsRequest->setTextMatchStyle($textMatchStyle);
        $dsRequest->setData($data);
        $dsRequest->setOldValues($oldValues);
        
        return $dsRequest;
    }
}