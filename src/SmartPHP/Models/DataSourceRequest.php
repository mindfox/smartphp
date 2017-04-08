<?php
namespace SmartPHP\Models;

use SmartPHP\Interfaces\DataSourceRequestInterface;

class DataSourceRequest implements DataSourceRequestInterface
{

    private static $KeyPrefix = "isc_";
    
    private static $TransactionKey = "transaction";

    private static $DataFormatKey = "dataFormat";
    
    private static $ISCMetaDataPrefixKey = "isc_metaDataPrefix";

    private $data = [];

    private function normalizeArray(array $array): array
    {
        $normalized = [];
        $metaDataPrefix = strval($array[self::$ISCMetaDataPrefixKey] ?? "");
        
        foreach ($array as $key => $value) {
            if (strpos($key, self::$KeyPrefix) === 0) {
                $key = substr($key, strlen(self::$KeyPrefix));
            } else {
                $key = substr($key, strlen($metaDataPrefix));
            }
            $normalized[$key] = $value;
        }
        
        return $normalized;
    }

    public function isTransaction(): bool
    {
        return (isset($this->data[self::$TransactionKey]) && is_array($this->data[self::$TransactionKey]));
    }

    public function getDataFormat(): string
    {
        return strval($this->data[self::$DataFormatKey]);
    }

    private function getRawTransactionData()
    {
        $rawTransactionData = $this->data[self::$TransactionKey];
        $rawTransactionData[self::$DataFormatKey] = $rawTransactionData[self::$DataFormatKey] ?? $this->getDataFormat();
        return $rawTransactionData;
    }

    public function getData(): array
    {
        if ($this->isTransaction()) {
            return $this->getRawTransactionData();
        }
        return $this->data;
    }

    public function setData(array $data): DataSourceRequestInterface
    {
        $this->data = $this->normalizeArray($data);
        return $this;
    }
}