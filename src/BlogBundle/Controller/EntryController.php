<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Category;
use BlogBundle\Entity\Entry;
use BlogBundle\Form\EntryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class EntryController extends Controller
{
    private $session;

    public function __construct()
    {
        $this->session=new Session();
    }

    public function addAction(Request $request)
    {
        $entry=new Entry();
        $form=$this->createForm(EntryType::class,$entry);
        $em=$this->getDoctrine()->getManager();
        $rcategory=$em->getRepository(Category::class);

        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){
                $entry->setTitle($form->get("title")->getData());
                $entry->setContent($form->get("content")->getData());
                $entry->setAuthor($this->getUser());
                $entry->setImage("null");

                $category=$rcategory->find($form->get("category")->getData());
                $entry->setCategory($category);

                $em->persist($entry);
                $flush=$em->flush();

                if($flush==null){
                    $status="La entrada se ha creado correctamente";
                }else{
                    $status="Error al crear la entrada";
                }

                $this->session->getFlashBag()->add("status",$status);
                //return $this->redirectToRoute("blog_index_entry");
            }
        }

        return $this->render('BlogBundle:Entry:add.html.twig', [
            "form"=>$form->createView()
        ]);
    }

    public function EditAction()
    {
        return $this->render('BlogBundle:Entry:edit.html.twig', array(
            // ...
        ));
    }

    public function indexAction()
    {
        $em=$this->getDoctrine()->getManager();
        $entries=$em->getRepository(Entry::class)->findAll();

        return $this->render('BlogBundle:Entry:index.html.twig',[
            "entries"=>$entries
        ]);

    }

}
