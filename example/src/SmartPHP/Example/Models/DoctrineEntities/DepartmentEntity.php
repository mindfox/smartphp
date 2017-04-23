<?php
namespace SmartPHP\Example\Models\DoctrineEntities;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="smartphp_departments")
 * @ORM\Entity(repositoryClass="SmartPHP\Example\Services\DoctrineRepositories\DoctrineDepartmentRepository")
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
     * @var CompanyEntity
     *
     * @ORM\ManyToOne(targetEntity="CompanyEntity", inversedBy="departments")
     * @ORM\JoinColumn(name="CompanyID", referencedColumnName="ID")
     */
    private $company;
    
    /**
     *
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="EmployeeEntity", mappedBy="department")
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
    public function addEmployee(\SmartPHP\Example\Models\DoctrineEntities\EmployeeEntity $employee)
    {
        $this->employees[] = $employee;

        return $this;
    }

    /**
     * Remove employee
     *
     * @param \SmartPHP\Example\Models\Entities\EmployeeEntity $employee
     */
    public function removeEmployee(\SmartPHP\Example\Models\DoctrineEntities\EmployeeEntity $employee)
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

    /**
     * Set company
     *
     * @param \SmartPHP\Example\Models\Entities\CompanyEntity $company
     *
     * @return DepartmentEntity
     */
    public function setCompany(\SmartPHP\Example\Models\DoctrineEntities\CompanyEntity $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \SmartPHP\Example\Models\Entities\CompanyEntity
     */
    public function getCompany()
    {
        return $this->company;
    }
}
