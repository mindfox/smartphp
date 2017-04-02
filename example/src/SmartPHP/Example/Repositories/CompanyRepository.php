<?php
namespace SmartPHP\Example\Repositories;

use Doctrine\ORM\EntityRepository;
use SmartPHP\Example\Models\Entities\CompanyEntity;

class CompanyRepository extends EntityRepository
{
    public function add(CompanyEntity $company): CompanyEntity
    {
        $this->getEntityManager()->persist($company);
        $this->getEntityManager()->flush();
        return $company;
    }
}