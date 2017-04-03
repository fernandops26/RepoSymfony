<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Author;
use BlogBundle\Entity\Entry;
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
            echo $author->getEmail()."</br>";
            echo $author->getRole()."</br>";

            $entries=$author->getEntries();

            echo "<hr>";

            foreach ($entries as $entry) {
                echo $entry->getTitle()."</br>";
                $entryTag = $entry->getEntryTag();

                foreach ($entryTag as $tag){
                    echo $tag->getTag()->getName()." ";
                }
            }
        }

        die();

    }
    
    public function homeAction(){
        $em=$this->getDoctrine()->getManager();
        $entries=$em->getRepository(Entry::class)->findAll();
        return $this->render('BlogBundle:Default:homepage.html.twig',[
            "entries"=>$entries
        ]);
    }
}
