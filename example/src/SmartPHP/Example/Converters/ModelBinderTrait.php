<?php
namespace SmartPHP\Example\Converters;

use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

trait ModelBinderTrait
{

    public function bind(array $data, string $class)
    {
        $normalizer = new GetSetMethodNormalizer();
        return $normalizer->denormalize($data, $class);
    }
}