<?php
namespace maxmeffert\smartphp;

interface DataSourceServiceInterface
{
    public function fetch(): DataSourceResponse;
    public function add(): DataSourceResponse;
    public function update(): DataSourceResponse;
    public function remove(): DataSourceResponse;
}