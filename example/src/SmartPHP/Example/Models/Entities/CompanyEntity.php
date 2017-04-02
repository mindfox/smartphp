<?php
namespace SmartPHP\Example\Models\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="smartphp_companies")
 * @ORM\Entity(repositoryClass="SmartPHP\Example\Repositories\CompanyRepository")
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
}
