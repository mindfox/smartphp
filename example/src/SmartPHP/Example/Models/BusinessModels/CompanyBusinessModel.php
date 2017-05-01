<?php
namespace SmartPHP\Example\Models\BusinessModels;

use Sabertooth\Collections\CollectionInterface;
use Sabertooth\Collections;

class CompanyBusinessModel
{

    /**
     *
     * @var string
     */
    private $id;

    /**
     *
     * @var string
     */
    private $name;

    /**
     *
     * @var CollectionInterface
     */
    private $departments;

    public function __construct()
    {
        $this->departments = Collections::newArrayCollection();
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getDepartments(): CollectionInterface
    {
        return $this->departments;
    }

    public function setDepartments(CollectionInterface $departments)
    {
        $this->departments = $departments;
        return $this;
    }
}
