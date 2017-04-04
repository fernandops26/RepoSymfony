<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Author;
use BlogBundle\Entity\Category;
use BlogBundle\Entity\Entry;
use BlogBundle\Entity\Tag;
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
    
    public function homeAction($page,$category_id){
        $em=$this->getDoctrine()->getManager();
        $max_results=2;
        $entries=$em->getRepository(Entry::class)->paginateEntry($max_results,$page,$category_id);

        $categories=$em->getRepository(Category::class)->findAll();

        return $this->render('BlogBundle:Default:homepage.html.twig',[
            "entries"=>$entries,
            "current_page"=>$page,
            "max_pages"=>round($entries->count()/$max_results),
            "category_id"=>$category_id,
            "categories"=>$categories
        ]);
    }
}
