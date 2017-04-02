<?php
namespace SmartPHP\Doctrine;

use SmartPHP\Interfaces\DataSourceServiceInterface;
use Doctrine\ORM\EntityRepository;
use SmartPHP\Interfaces\DataSourceMessageInterface;

class DoctrineService implements DataSourceServiceInterface
{

    /**
     * 
     * @var EntityRepository
     */
    private $entityRepository;
    
    public function __construct(EntityRepository $entityRepository)
    {
        $this->entityRepository = $entityRepository;
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceServiceInterface::fetch()
     */
    public function fetch(DataSourceMessageInterface $message)
    {
        
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceServiceInterface::add()
     */
    public function add(DataSourceMessageInterface $message)
    {
        // TODO: Auto-generated method stub
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceServiceInterface::update()
     */
    public function update(DataSourceMessageInterface $message)
    {
        // TODO: Auto-generated method stub
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SmartPHP\Interfaces\DataSourceServiceInterface::remove()
     */
    public function remove(DataSourceMessageInterface $message)
    {
        // TODO: Auto-generated method stub
    }
}