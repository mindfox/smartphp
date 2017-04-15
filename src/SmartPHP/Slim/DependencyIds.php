<?php
namespace SmartPHP\Slim;

abstract class DependencyIds
{

    const CONFIG = "SmartPHP";

    const DENORMALIZER = "SmartPHP/Denormalizer";

    const SERIALIZER = "SmartPHP/Serializer";

    const DS_RESPONSE_SERIALIZER = "SmartPHP/ResponseSerializer";

    const DS_REQUEST_FACTORY = "SmartPHP/RequestFactory";

    const DS_OPERATION_FACTORY = "SmartPHP/OperationFactory";

    const DS_TRANSACTION_FACTORY = "SmartPHP/TransactionFactory";

    const DATASOURCE_FACTORY = "SmartPHP/DataSourceFactory";

    const DATASORUCE_EXECUTOR = "SmartPHP/DataSourceExecutor";

    const DATASORUCE_MODELCONVERTER_FACTORY = "SmartPHP/DataSourceModelConverterFactory";
}
