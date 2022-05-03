<?php

namespace App\Tool;

use Doctrine\ORM\EntityManagerInterface;

class EntityManager
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    
    public function __construct(EntityManagerInterface $entityManger)
    {
        $this->entityManager = $entityManger;
    }

    /**
     * Function add entity
     *
     * @param object $entity
     * @return void
     */
    public function Add(object $entity)
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    /**
     * Function update entity
     *
     * @return void
     */
    public function update()
    {
        $this->entityManager->flush();
    }

    /**
     * Function remove entity
     *
     * @param Object $entity
     * @return void
     */
    public function remove(Object $entity)
    {
        $this->entityManager->Remove($entity);
        $this->entityManager->flush();
    }
}