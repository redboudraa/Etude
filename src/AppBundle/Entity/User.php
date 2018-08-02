<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Roles;
use Doctrine\ORM\EntityManager; 
use Doctrine\Common\Persistence\Mapping\ClassMetadata;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectManagerAware;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
/**
 * @ORM\Table(name="fos_user")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class User extends BaseUser 
{

 

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct();
        // your own logic
          $this->em = $objectManager;
    }
    
    public function getRoles()
    { /*$roles = $this->roles;
     $rol=$this->getDoctrine()
        ->getRepository('AppBundle:Roles')
        ->findByStatue('Admin');
     foreach ($rol as $item) {
               $roles[] = $item->getRole();
        }
      $rol=$this->getDoctrine()
        ->getRepository(User::class)
        ->findRole();*/
        
        

   /* $query =  $this->em->createQuery(
        'SELECT p
        FROM App\Entity\Roles p'
    );*/
    global $kernel;

$em = $kernel->getContainer()->get('doctrine')->getManager();
$role = $em->getRepository('AppBundle:Roles')->findByStatue( $this->id );
foreach ($role as $key) {
     $roles[] = $key->getRole();
}
        // give everyone ROLE_USER!
        // if (!in_array('ROLE_USER', $roles)) {
       //      $roles[] = 'ROLE_USER';
             $roles[] = 'ROLE_USER';
       //  }
        return $roles;
    }
      public function setRoles(array $roles)
    {
        $this->roles = $roles;
    }
   

}
