<?php
namespace SmartPHP\Example\Models\Entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Table(name="smartphp_departments")
 * @ORM\Entity(repositoryClass="SmartPHP\Example\Repositories\DepartmentRepository")
 */
class DepartmentEntity
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
     * @ORM\Column(name="Name", type="string", length=255, nullable=false)
     */
    private $name;
    
    /**
     * 
     * @var Collection
     * 
     * @ORM\ManyToMany(targetEntity="EmployeeEntity")
     * @ORM\JoinTable(
     *      name="smartphp_departments_employees",
     *      joinColumns={@ORM\JoinColumn(name="DepartmentID", referencedColumnName="ID")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="EmployeeID", referencedColumnName="ID", unique=true)}
     *      )
     */
    private $employees;
    
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
     * Constructor
     */
    public function __construct()
    {
        $this->employees = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add employee
     *
     * @param \SmartPHP\Example\Models\Entities\EmployeeEntity $employee
     *
     * @return DepartmentEntity
     */
    public function addEmployee(\SmartPHP\Example\Models\Entities\EmployeeEntity $employee)
    {
        $this->employees[] = $employee;

        return $this;
    }

    /**
     * Remove employee
     *
     * @param \SmartPHP\Example\Models\Entities\EmployeeEntity $employee
     */
    public function removeEmployee(\SmartPHP\Example\Models\Entities\EmployeeEntity $employee)
    {
        $this->employees->removeElement($employee);
    }

    /**
     * Get employees
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEmployees()
    {
        return $this->employees;
    }
}
