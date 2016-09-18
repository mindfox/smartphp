<?php
namespace intrawarez\smartphp;

class DSRequest
{
    
    /**
     *
     * @var string
     */
    private $componentId;
    
    /**
     *
     * @var array
     */
    private $data;
    
    /**
     *
     * @var array
     */
    private $oldValues;
    
    /**
     *
     * @var string
     */
    private $dataSource;
    
    /**
     *
     * @var string
     */
    private $operationType;

    /**
     *
     * @var string
     */
    private $textMatchStyle;
    
    public function getComponentId(): string
    {
        return $this->componentId;
    }
    
    public function setComponentId(string $componentId)
    {
        $this->componentId = $componentId;
    }
    
    public function getData(): array
    {
        return $this->data;
    }
        
    public function setData(array $data)
    {
        $this->data = $data;
    }
    
    public function getOldValues(): array
    {
        return $this->oldValues;
    }
    
    public function setOldValues(array $oldValues)
    {
        $this->oldValues = $oldValues;
    }
    
    public function getDataSource(): string
    {
        return $this->dataSource;
    }
    
    public function setDataSource(string $dataSource)
    {
        $this->dataSource = $dataSource;
    }
    
    public function getOperationType(): string
    {
        return $this->operationType;
    }
    
    public function setOperationType(string $operationType)
    {
        $this->operationType = $operationType;
    }
    
    public function getTextMatchStyle(): string
    {
        return $this->textMatchStyle;
    }
    
    public function setTextMatchStyle(string $textMatchStyle)
    {
        $this->textMatchStyle = $textMatchStyle;
    }
}
