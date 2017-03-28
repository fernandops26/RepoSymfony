<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Author;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('BlogBundle:Default:index.html.twig');
    }

    public function allAuthorsAction(){
        $author_repo=$this->getDoctrine()->getRepository(Author::class);
        $authors=$author_repo->findAll();



        foreach($authors as $author){
            echo $author->getName()."</br>";
            echo $author->getSurname()."</br>";
        }

        die();

    }
}
