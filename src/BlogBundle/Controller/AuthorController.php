<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Author;
use BlogBundle\Form\AuthorType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AuthorController extends Controller
{
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
}
