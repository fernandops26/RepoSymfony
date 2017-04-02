<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Tag;
use BlogBundle\Form\TagType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class TagController extends Controller
{
    private $session;

    public function __construct()
    {
        $this->session=new Session();
    }

    public function addAction(Request $request)
    {
        $tag=new Tag();
        $em=$this->getDoctrine()->getManager();
        $form=$this->createForm(TagType::class,$tag);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){

                $tag->setName($form->get("name")->getData());
                $tag->setDescription($form->get("description")->getData());

                $em->persist($tag);
                $flush=$em->flush();

                if($flush==null){
                    $status="El tag se ha creado correctamente";
                }else{
                    $status="Error al crear el tag";
                }

                $this->session->getFlashBag()->add("status",$status);
                return $this->redirectToRoute("blog_index_tag");
            }
        }

        return $this->render('BlogBundle:Tag:add.html.twig', [
            "form"=>$form->createView()
        ]);
    }

    public function indexAction(){
        $em=$this->getDoctrine()->getManager();
        $tags=$em->getRepository(Tag::class)->findAll();
        return $this->render("BlogBundle:Tag:index.html.twig",[
            "tags"=>$tags
        ]);
    }

    public function deleteAction($id){
        $em=$this->getDoctrine()->getManager();
        $tag=$em->getRepository(Tag::class)->find($id);

        $em->remove($tag);

        $em->flush();

        return $this->redirectToRoute("blog_index_tag");
    }

}
