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
    public function fetch($object = null): array;
    
    /**
     * 
     * @param object $object
     */
    public function insert($object): array;
    
    /**
     * 
     * @param object $object
     */
    public function update($object): array;
    
    /**
     * 
     * @param object $object
     */
    public function delete($object): array;
}
