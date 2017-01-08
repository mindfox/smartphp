<?php
namespace intrawarez\smartphp;

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
