<?php
namespace maxmeffert\smartphp;

use Slim\Interfaces\InvocationStrategyInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

class DataSourceInvocationStrategy implements InvocationStrategyInterface
{

    /**
     * 
     * @var SerializerInterface
     */
    private $serializer;
    
    public function __construct(SerializerInterface $serializer) {
        $this->serializer = $serializer;
    }
    /**
     *
     * {@inheritdoc}
     *
     * @see \Slim\Interfaces\InvocationStrategyInterface::__invoke()
     */
    public function __invoke($callable, ServerRequestInterface $request, ResponseInterface $response, array $routeArguments)
    {
        $response = new DataSourceResponse($response, $this->serializer);
        
        $result = call_user_func($callable);
        
        if ($result instanceof ResponseInterface) {
            return $result;
        }
        
        $response->setData($result);
        
        return $response->serialize("json");
    }
}