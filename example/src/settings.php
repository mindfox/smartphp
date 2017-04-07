<?php
$configDir = __DIR__ . "/../config";

return [
    
    "settings" => [
        
        "displayErrorDetails" => true, // set to false in production
        
        "addContentLengthHeader" => false // Allow the web server to send the content-length header
    
    ],
    
    "databases" => require $configDir . "/databases.php",
    
    "doctrine" => [
        
        "annotationMetadataConfiguration" => [
            
            "paths" => [
                __DIR__ . "/SmartPHP/Example/Models/Entities"
            ],
            
            "isDevMode" => true,
            
            "proxyDir" => __DIR__ . "/SmartPHP/Example/Models/Proxies",
            
            "cache" => null,
            
            "useSimpleAnnotationReader" => false
        
        ],
        
        "entityNamespaces" => [
            
            "" => "SmartPHP\Example\Models\Entities"
        
        ]
    
    ]

];
