<?php
namespace SmartPHP\Traits;

use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

trait ModelBinderTrait
{

    public function bind(array $data, string $class)
    {
        $denormalizer = new GetSetMethodNormalizer();
        return $denormalizer->denormalize($data, $class);
    }

    public function bindMerged(array $newData, array $oldData, string $class)
    {
        $data = array_merge($oldData, $newData);
        return $this->bind($data, $class);
    }

    public function unbind($object): array
    {
        $normalizer = new GetSetMethodNormalizer();
        return $normalizer->normalize($object);
    }
}
