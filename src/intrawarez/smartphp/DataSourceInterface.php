<?php
namespace intrawarez\smartphp;

interface DataSourceInterface extends \Countable
{
    /**
     * 
     */
    public function size();
    
    /**
     * 
     */
    public function fetch($object = null);
    
    /**
     * 
     * @param object $object
     */
    public function insert($object);
    
    /**
     * 
     * @param object $object
     */
    public function update($object);
    
    /**
     * 
     * @param object $object
     */
    public function delete($object);
}
