<?php

namespace AppBundle\Controller;
use Symfony\Component\HttpFoundation\Response;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Roles;
class DefaultController extends Controller
{
      

    /**
     * @Route("/home", name="home")
     */
    public function homeAction(Request $request)
    {
            return $this->render('home.html.twig');
    }

    


    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
//$this->denyAccessUnlessGranted('ROLE_ADMIN');
        // if (!$this->get('security.authorization_checker')->isGranted('ROLE_MAGIC')) {
            // throw $this->createAccessDeniedException('GET OUT!');
        // }
        // replace this example code with whatever you need
$roles=$this->getDoctrine()
        ->getRepository('AppBundle:Roles')
        ->findByStatue('ADMIN');
$todos = (array) $roles;
//dump($request);
    $em= $this->getDoctrine()->getManager();

if($request->request->count() > 0)
{
    $nom=$request->request->get('role_user');
    $nom1=$request->request->get('role_magic');
    $nom2=$request->request->get('role_admin');
 //   die($nom2);
    $n=$request->request->get('role');
      $r= $this->getDoctrine()
        ->getRepository('AppBundle:Roles')
        ->findOneBy([
    'role' => 'ROLE_USER',
    'statue' => $n,
                    ]);
        
    if($nom=="on" && $r==null)
    {
        $product = new Roles();
        $product->setRole('ROLE_USER');
        $product->setStatue($n);
       

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $em->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $em->flush();
        }else if($r!=null && $nom!="on"  )
        {
          
          $em->remove($r); 
          $em->flush();
        }

 $r= $this->getDoctrine()
        ->getRepository('AppBundle:Roles')
        ->findOneBy([
    'role' => 'ROLE_MAGIC',
    'statue' => $n,
                    ]);
        
    if($nom1=="on" && $r==null)
    {
        $product = new Roles();
        $product->setRole('ROLE_MAGIC');
        $product->setStatue($n);
       

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $em->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $em->flush();
        }else if($r!=null && $nom1!="on"  )
        {
          
          $em->remove($r); 
          $em->flush();
        }
//--------------------------------------
$r= $this->getDoctrine()
        ->getRepository('AppBundle:Roles')
        ->findOneBy([
    'role' => 'ROLE_ADMIN',
    'statue' => $n,
                    ]);
        
    if($nom2=="on" && $r==null)
    {
        $product = new Roles();
        $product->setRole('ROLE_ADMIN');
        $product->setStatue($n);
       

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $em->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $em->flush();
        }else if($r!=null && $nom2!="on"  )
        {
          
          $em->remove($r); 
          $em->flush();
        }
        
}
//var_dump($todos);
$todo="yo";
$status=$this->getDoctrine()
        ->getRepository('AppBundle:Status')
        ->findAll();
        $arrays= array();
        $i=0;
foreach ($status as $stat ) {
    $name=$stat->getName();
    $roles1=$this->getDoctrine()
        ->getRepository('AppBundle:Roles')
        ->findByStatue($name);
    $arrays[]=array('title'=>$name, 'title1'=>$roles1);
    $i++;
}
dump($request);
//var_dump($arrays);
       return $this->render('default/index.html.twig',array('todos'=>$todo,'status'=>$status,'arr'=>$arrays));
    }

}
