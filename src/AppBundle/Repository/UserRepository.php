<?php  
// src/AppBundle/Repository/ProductRepository.php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function findrole()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM AppBundle:Roles p '
            )
            ->getResult();
    }
}