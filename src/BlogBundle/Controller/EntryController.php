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
        $repo_category=$em->getRepository(Category::class);
        $repo_entry=$em->getRepository(Entry::class);

        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){
                $entry->setTitle($form->get("title")->getData());
                $entry->setContent($form->get("content")->getData());
                $entry->setStatus($form->get("status")->getData());
                $entry->setAuthor($this->getUser());
                //UPLOAD IMAGE
                $file=$form["image"]->getData();
                $ext=$file->guessExtension();
                $filename=time().'.'.$ext;
                $file->move("uploads",$filename);
                //END UPLOAD

                $entry->setImage($filename);
                $category=$repo_category->find($form->get("category")->getData());
                $entry->setCategory($category);


                $em->persist($entry);
                $flush=$em->flush();

                //SAVE TAGS
                $repo_entry->saveEntryTags(
                    $form->get("tags")->getData(),
                    $form->get("title")->getData(),
                    $form->get("category")->getData(),
                    $this->getUser(),
                    $entry
                );
                //END SAVE

                if($flush==null){
                    $status="La entrada se ha creado correctamente";
                }else{
                    $status="Error al crear la entrada";
                }

                $this->session->getFlashBag()->add("status",$status);
                return $this->redirectToRoute("blog_homepage");
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