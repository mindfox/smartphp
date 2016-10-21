<?php
namespace intrawarez\smartphp\test\datasource;

use PHPUnit\Framework\TestCase;
use intrawarez\smartphp\datasource\DSRequest;

class DSRequestTest extends TestCase
{
    public function testGetComponentId()
    {
        $request = new DSRequest();
        
        $this->assertAttributeEquals($request->getComponentId(), "componentId", $request);
    }
    
    public function testSetComponentId()
    {
        $componentId = "someValue";
        
        $request = new DSRequest();
        $request->setComponentId($componentId);
        
        $this->assertAttributeEquals($componentId, "componentId", $request);
    }
    
    public function testGetData()
    {
        $request = new DSRequest();
        
        $this->assertAttributeEquals($request->getData(), "data", $request);
    }
    
    public function testSetData()
    {
        $data = [ "foo" => "bar" ];
        
        $request = new DSRequest();
        $request->setData($data);
        
        $this->assertAttributeEquals($data, "data", $request);
    }
    
    public function testGetOldValues()
    {
        $request = new DSRequest();
        
        $this->assertAttributeEquals($request->getOldValues(), "oldValues", $request);
    }
    
    public function testSetOldValues()
    {
        $oldValues = [ "foo" => "bar" ];
        
        $request = new DSRequest();
        $request->setOldValues($oldValues);
        
        $this->assertAttributeEquals($oldValues, "oldValues", $request);
    }
    
    public function testGetDataSource()
    {
        $request = new DSRequest();
        
        $this->assertAttributeEquals($request->getDataSource(), "dataSource", $request);
    }
    
    public function testSetDataSource()
    {
        $dataSource = "someValue";
        
        $request = new DSRequest();
        $request->setDataSource($dataSource);
        
        $this->assertAttributeEquals($dataSource, "dataSource", $request);
    }
    
    public function testGetOperationType()
    {
        $request = new DSRequest();
        
        $this->assertAttributeEquals($request->getOperationType(), "operationType", $request);
    }
    
    public function testSetOperationType()
    {
        $operationType = "someValue";
        
        $request = new DSRequest();
        $request->setOperationType($operationType);
        
        $this->assertAttributeEquals($operationType, "operationType", $request);
    }
    
    public function testGetTextMatchStyle()
    {
        $request = new DSRequest();
        
        $this->assertAttributeEquals($request->getTextMatchStyle(), "textMatchStyle", $request);
    }
    
    public function testSetTextMatchStyle()
    {
        $textMatchStyle = "someValue";
        
        $request = new DSRequest();
        $request->setTextMatchStyle($textMatchStyle);
        
        $this->assertAttributeEquals($textMatchStyle, "textMatchStyle", $request);
    }
}
