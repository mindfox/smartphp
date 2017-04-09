<?php
namespace SmartPHP\Example\Models\Entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Table(name="smartphp_companies")
 * @ORM\Entity
 */
class CompanyEntity
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
     * @ORM\OneToMany(targetEntity="DepartmentEntity", mappedBy="company", cascade={"persist"})
     */
    private $departments;

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
        $this->departments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add department
     *
     * @param \SmartPHP\Example\Models\Entities\DepartmentEntity $department
     *
     * @return CompanyEntity
     */
    public function addDepartment(\SmartPHP\Example\Models\Entities\DepartmentEntity $department)
    {
        $this->departments[] = $department;

        return $this;
    }

    /**
     * Remove department
     *
     * @param \SmartPHP\Example\Models\Entities\DepartmentEntity $department
     */
    public function removeDepartment(\SmartPHP\Example\Models\Entities\DepartmentEntity $department)
    {
        $this->departments->removeElement($department);
    }

    /**
     * Get departments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDepartments()
    {
        return $this->departments;
    }
}
