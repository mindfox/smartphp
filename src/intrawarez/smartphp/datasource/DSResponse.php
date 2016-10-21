<?php
namespace intrawarez\smartphp\datasource;

/**
 *
 * @author maxmeffert
 */
class DSResponse
{
    /**
     * @var int
     */
    private $status;
    
    /**
     * @var int
     */
    private $startRow;
    
    /**
     * @var int
     */
    private $endRow;
    
    /**
     * @var int
     */
    private $totalRows;
    
    /**
     * @var array
     */
    private $data;
    
    public function getStatus(): int
    {
        return $this->status;
    }
    
    public function setStatus(int $status): self
    {
        $this->status = $status;
        return $this;
    }
    
    public function getStartRow(): int
    {
        return $this->startRow;
    }
    
    public function setStartRow(int $startRow): self
    {
        $this->startRow = $startRow;
        return $this;
    }
    
    public function getEndRow(): int
    {
        return $this->endRow;
    }
 
    public function setEndRow(int $endRow): self
    {
        $this->endRow = $endRow;
        return $this;
    }
    
    public function getTotalRows(): int
    {
        return $this->totalRows;
    }
    
    public function setTotlaRows(int $totalRows): self
    {
        $this->totalRows = $totalRows;
        return $this;
    }
    
    public function getData(): array
    {
        return $this->data;
    }
    
    public function setData(array $data)
    {
        $this->data = $data;
        return $this;
    }
}
