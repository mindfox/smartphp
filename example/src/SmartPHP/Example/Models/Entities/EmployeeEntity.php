<?php
namespace SmartPHP\Example\Models\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="smartphp_employees")
 * @ORM\Entity(repositoryClass="SmartPHP\Example\Repositories\EmployeeRepository")
 */
class EmployeeEntity
{
    
    /**
     *
     * @var string
     *
     * @ORM\Column(name="ID", type="guid", length=255, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;
    
    /**
     *
     * @var string
     *
     * @ORM\Column(name="FirstName", type="string", length=255, nullable=false)
     */
    private $firstName;
    
    /**
     *
     * @var string
     *
     * @ORM\Column(name="SecondName", type="string", length=255, nullable=false)
     */
    private $secondName;
    
    /**
     *
     * @var string
     *
     * @ORM\Column(name="BirthDate", type="date", length=255, nullable=false)
     */
    private $birthDate;
    
    /**
     *
     * @var string
     *
     * @ORM\Column(name="Salary", type="integer", length=255, nullable=false)
     */
    private $salary;
    
    /**
     * Get id
     *
     * @return guid
     */
    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $this->id = $id;
        
        return $this;
    }
    
    /**
     * Set name
     *
     * @param string $name
     *
     * @return Company
     */
    public function setName($name)
    {
        $this->name = $name;
        
        return $this;
    }
    
    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return EmployeeEntity
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set secondName
     *
     * @param string $secondName
     *
     * @return EmployeeEntity
     */
    public function setSecondName($secondName)
    {
        $this->secondName = $secondName;

        return $this;
    }

    /**
     * Get secondName
     *
     * @return string
     */
    public function getSecondName()
    {
        return $this->secondName;
    }

    /**
     * Set birthDate
     *
     * @param \DateTime $birthDate
     *
     * @return EmployeeEntity
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get birthDate
     *
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set salary
     *
     * @param integer $salary
     *
     * @return EmployeeEntity
     */
    public function setSalary($salary)
    {
        $this->salary = $salary;

        return $this;
    }

    /**
     * Get salary
     *
     * @return integer
     */
    public function getSalary()
    {
        return $this->salary;
    }
}
