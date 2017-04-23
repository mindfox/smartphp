<?php
namespace Smartphp\example\models\BusinessModels;

class DepartmentBusinessModel
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
     * @var CompanyBusinessModel
     */
    private $company;

    /**
     *
     * @var array
     */
    private $employees = [];

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

    public function getCompany()
    {
        return $this->company;
    }

    public function setCompany(CompanyBusinessModel $company)
    {
        $this->company = $company;
        return $this;
    }

    public function getEmployees()
    {
        return $this->employees;
    }

    public function setEmployees(array $employees)
    {
        $this->employees = $employees;
        return $this;
    }
}
