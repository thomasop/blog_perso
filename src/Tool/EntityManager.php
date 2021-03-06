<?php

namespace App\Tool;

use Doctrine\ORM\EntityManagerInterface;

class EntityManager
{
    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManger)
    {
        $this->entityManager = $entityManger;
    }

    public function Add(object $entity)
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    public function update()
    {
        $this->entityManager->flush();
    }

    public function remove(Object $entity)
    {
        $this->entityManager->Remove($entity);
        $this->entityManager->flush();
    }
}
