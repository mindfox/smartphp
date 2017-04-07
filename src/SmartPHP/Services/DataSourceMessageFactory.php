<?php
namespace SmartPHP\Services;

use Psr\Http\Message\ServerRequestInterface;
use SmartPHP\Interfaces\DataSourceMessageFactoryInterface;
use SmartPHP\Interfaces\DataSourceOperationInterface;
use SmartPHP\Models\DataSourceOperation;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

class DataSourceMessageFactory implements DataSourceMessageFactoryInterface
{

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

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\DataSourceMessageFactoryInterface::createFromArray()
     */
    public function createFromArray(array $array): DataSourceMessageInterface
    {
        $array = $this->normalizeArray($array);
        var_dump($array); die();
        $normalizer = new GetSetMethodNormalizer();
        $message = $normalizer->denormalize($array, DataSourceOperation::class);
        return $message;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\DataSourceMessageFactory::createFromServerRequestInterface()
     */
    public function createFromServerRequest(ServerRequestInterface $request): DataSourceMessageInterface
    {
        $parsedBody = $request->getParsedBody() ?? [];
        $queryParams = $request->getQueryParams() ?? [];
        $array = array_merge($parsedBody, $queryParams);
        return $this->createFromArray($array);
    }
}