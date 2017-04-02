<?php
namespace maxmeffert\smartphp;

class DataSourceResponseModel
{

    /**
     *
     * @var int
     */
    private $status;

    /**
     *
     * @var int
     */
    private $startRow;

    /**
     *
     * @var int
     */
    private $endRow;

    /**
     *
     * @var int
     */
    private $totalRows;

    /**
     *
     * @var mixed
     */
    private $data;

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function getStartRow()
    {
        return $this->startRow;
    }

    public function setStartRow($startRow)
    {
        $this->startRow = $startRow;
        return $this;
    }

    public function getEndRow()
    {
        return $this->endRow;
    }

    public function setEndRow($endRow)
    {
        $this->endRow = $endRow;
        return $this;
    }

    public function getTotalRows()
    {
        return $this->totalRows;
    }

    public function setTotalRows($totalRows)
    {
        $this->totalRows = $totalRows;
        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }
}