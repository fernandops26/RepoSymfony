<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Author;
use BlogBundle\Form\AuthorType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class AuthorController extends Controller
{
    private $session;

    public function __construct()
    {
        $this->session=new Session();
    }

    public function getAuthorsAction(){
        $author_repo=$this->getDoctrine()->getRepository(Author::class);
        $authors=$author_repo->findAll();
        return $this->render('BlogBundle:Author:index.html.twig',[
           "authors"=>$authors
        ]);
    }
    
    public function newAuthorAction(){
        $author=new Author();
        $form=$this->createForm(AuthorType::class,$author);

        
        return $this->render('BlogBundle:Author:new.html.twig',[
            "form"=>$form->createView()
        ]);
    }

    public function registerAction(){
        return $this->render('BlogBundle:Author:register.html.twig');
    }

    public function loginAction(Request $request){
        $authenticationUtils=$this->get("security.authentication_utils");
        $error=$authenticationUtils->getLastAuthenticationError();
        $lastUsername=$authenticationUtils->getLastUsername();
        $status="";

        $author=new Author();
        $form=$this->createForm(AuthorType::class,$author);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            $author->setName($form->get("name")->getData());
            $author->setSurname($form->get("surname")->getData());
            $author->setEmail($form->get("email")->getData());
            $author->setPassword($form->get("password")->getData());
            $author->setRole("ROLE_AUTHOR");
            $author->setImagen("none.jpg");

            $em=$this->getDoctrine()->getManager();
            $em->persist($author);
            $flush=$em->flush();

            if($flush==null){
                $status="Se registro correctamente";
            }else{
                $status="Error al registrar";
            }
            $this->session->getFlashBag()->add("status",$status);
        }




        return $this->render("BlogBundle:Author:login.html.twig",[
            "error"=>$error,
            "lastUsername"=>$lastUsername,
            "form"=>$form->createView()
        ]);
    }
}
