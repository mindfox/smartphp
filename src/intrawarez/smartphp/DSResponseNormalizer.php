<?php
namespace intrawarez\smartphp;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class DSResponseNormalizer implements NormalizerInterface
{
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof DSResponse;
    }
    
    public function normalize($object, $format = null, array $context = [])
    {
        /**
         * @var DSResponse $object
         */        
        return [
            "response" => [
                "data" => $object->getData()
            ]
        ];
    }
}
