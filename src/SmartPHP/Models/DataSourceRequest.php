<?php
namespace SmartPHP\Models;

use SmartPHP\Interfaces\DataSourceRequestInterface;

class DataSourceRequest implements DataSourceRequestInterface
{
    private $data = [];

    private function normalizeArray(array $array): array
    {
        $normalized = [];
        $metaDataPrefix = strval($array["isc_metaDataPrefix"] ?? "");
        
        foreach ($array as $key => $value) {
            if (strpos($key, "isc_") === 0) {
                $key = substr($key, strlen("isc_"));
            } else {
                $key = substr($key, strlen($metaDataPrefix));
            }
            $normalized[$key] = $value;
        }
        
        return $normalized;
    }
    
    public function isTransaction(): bool
    {
        return isset($this->data["transaction"]) && is_array($this->data["transaction"]);
    }
    
    public function getData(): array
    {
        return $this->data;
    }

    public function setData(array $data): DataSourceRequestInterface
    {
        $this->data = $this->normalizeArray($data);
        return $this;
    }
 
    
    
}