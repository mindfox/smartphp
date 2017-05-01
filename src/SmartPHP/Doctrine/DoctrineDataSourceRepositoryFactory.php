<?php
namespace SmartPHP\Doctrine;

use Doctrine\ORM\Repository\RepositoryFactory;
use Doctrine\ORM\EntityManagerInterface;
use DI\Container;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\Mapping\ClassMetadata;

class DoctrineDataSourceRepositoryFactory implements RepositoryFactory
{

    private $repositories = [];

    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    private function getClassMetadata(EntityManagerInterface $entityManager, $entityName): ClassMetadata
    {
        return $entityManager->getClassMetadata($entityName);
    }

    private function getRepositoryClassName(EntityManagerInterface $entityManager, ClassMetadata $classMetadata): string
    {
        return $classMetadata->customRepositoryClassName ?? $entityManager->getConfiguration()->getDefaultRepositoryClassName();
    }

    private function createRepository(EntityManagerInterface $entityManager, $entityName): ObjectRepository
    {
        $classMetadata = $this->getClassMetadata($entityManager, $entityName);
        $repositoryClassName = $this->getRepositoryClassName($entityManager, $classMetadata);
        return $this->container->make($repositoryClassName, [
            EntityManagerInterface::class => $entityManager,
            ClassMetadata::class => $classMetadata
        ]);
    }

    private function getRepositoryHash(EntityManagerInterface $entityManager, $entityName)
    {
        return $entityManager->getClassMetadata($entityName)->getName() . spl_object_hash($entityManager);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Doctrine\ORM\Repository\RepositoryFactory::getRepository()
     */
    public function getRepository(EntityManagerInterface $entityManager, $entityName)
    {
        $repositoryHash = $this->getRepositoryHash($entityManager, $entityName);
        if (! isset($this->repositories[$repositoryHash])) {
            $this->repositories[$repositoryHash] = $this->createRepository($entityManager, $entityName);
        }
        return $this->repositories[$repositoryHash];
    }
}
