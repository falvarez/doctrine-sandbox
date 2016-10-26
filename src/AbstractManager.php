<?php

class AbstractManager
{
    const REPOSITORY = null;

    /** @var Doctrine\ORM\EntityManager $entityManager */
    protected $entityManager;

    /**
     * @param Doctrine\ORM\EntityManager $entityManager
     */
    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return \Doctrine\ORM\EntityRepository
     */
    protected function getRepository()
    {
        return $this->entityManager->getRepository(static::REPOSITORY);
    }

    public function findAll()
    {
        return $this->getRepository()->findAll();
    }

    public function find($id)
    {
        return $this->entityManager->find(static::REPOSITORY, $id);
    }
}
