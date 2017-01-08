<?php
namespace intrawarez\smartphp\datasource;

/**
 *
 * @author maxmeffert
 */
class DSResponse
{
    private $data;
    
    public function getData()
    {
        return $this->data;
    }
    
    public function setData($data)
    {
        $this->data = $data;
    }
}
