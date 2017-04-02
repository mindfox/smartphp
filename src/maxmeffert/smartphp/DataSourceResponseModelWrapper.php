<?php
namespace maxmeffert\smartphp;

class DataSourceResponseModelWrapper
{

    /**
     *
     * @var DataSourceResponseModel
     */
    private $response;
    
    public function __construct()
    {
        $this->response = new DataSourceResponseModel();
    }
    
    public function getResponse()
    {
        return $this->response;
    }

    public function setResponse(DataSourceResponseModel $response)
    {
        $this->response = $response;
        return $this;
    }
    
    public function setData($data)
    {
        $this->response->setData($data);
        return $this;
    }
}