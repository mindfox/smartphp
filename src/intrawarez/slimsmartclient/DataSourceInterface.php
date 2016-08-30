<?php
namespace intrawarez\slimsmartclient;

interface DataSourceInterface
{
    
    public function fetch(DSRequest $dsRequest);
    public function insert(DSRequest $dsRequest);
    public function update(DSRequest $dsRequest);
    public function delete(DSRequest $dsRequest);
    
}
