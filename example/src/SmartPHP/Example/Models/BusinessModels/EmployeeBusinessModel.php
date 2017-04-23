<?php
namespace Smartphp\example\models\BusinessModels;

class EmployeeBusinessModel
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
    private $firstName;

    /**
     *
     * @var string
     */
    private $secondName;

    /**
     *
     * @var string
     */
    private $birthDate;

    /**
     *
     * @var string
     */
    private $salary;

    /**
     *
     * @var DepartmentBusinessModel
     */
    private $department;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getSecondName()
    {
        return $this->secondName;
    }

    public function setSecondName($secondName)
    {
        $this->secondName = $secondName;
        return $this;
    }

    public function getBirthDate()
    {
        return $this->birthDate;
    }

    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
        return $this;
    }

    public function getSalary()
    {
        return $this->salary;
    }

    public function setSalary($salary)
    {
        $this->salary = $salary;
        return $this;
    }

    public function getDepartment()
    {
        return $this->department;
    }

    public function setDepartment(DepartmentBusinessModel $department)
    {
        $this->department = $department;
        return $this;
    }
}
