<?php
namespace intrawarez\smartphp\datasource;

interface DataSourceInterface extends \Countable
{
    /**
     * 
     */
    public function size();
    
    /**
     * 
     */
    public function fetch($object = null, $textMatchStyle = DSTextMatchStyle::EXACT);
    
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
