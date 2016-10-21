<?php
namespace intrawarez\smartphp;

interface DataSourceInterface extends \Countable
{
    
    public function size();
    
    public function fetch();
    
    public function insert($object);
    
    public function update($object);
    
    public function delete($object);
}
