<?php
use Interop\Container\ContainerInterface;
use SmartPHP\Services\DataSourceMessageFactory;
use SmartPHP\Services\DataSourceMessageSerializer;
use SmartPHP\Services\DataSourceServiceFactory;
use SmartPHP\Services\DataSourceServiceInvokator;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

$c = [];

$c["settings"] = [
    
    // set to false in production
    'displayErrorDetails' => true,
    
    'addContentLengthHeader' => false
    
    // "outputBuffering" => false
    
];

$c["Serializer"] = function (ContainerInterface $c) {
    $encoders = [
        new JsonEncoder()
    ];
    
    $normalizers = [
        new GetSetMethodNormalizer()
    ];
    
    $serializer = new Serializer($normalizers, $encoders);
    
    return $serializer;
};

$c["SmartPHP/Serializer"] = function (ContainerInterface $c) {
    $serializer = $c->get("Serializer");
    return new DataSourceMessageSerializer($serializer);
};

$c["SmartPHP/MessageFactory"] = function (ContainerInterface $c) {
    return new DataSourceMessageFactory();
};

$c["SmartPHP/ServiceFactory"] = function (ContainerInterface $c) {
    return new DataSourceServiceFactory($c);
};

$c["SmartPHP/ServiceInvokator"] = function (ContainerInterface $c) {
    return new DataSourceServiceInvokator();
};

$c["testDS"] = function(ContainerInterface $c) {
    return new CountryService();
};

return $c;