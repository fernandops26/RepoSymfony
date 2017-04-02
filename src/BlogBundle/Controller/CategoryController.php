<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Category;
use BlogBundle\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class CategoryController extends Controller
{
    private $session;

    public function __construct()
    {
        $this->session=new Session();
    }

    public function addAction(Request $request)
    {
        $category=new Category();
        $form=$this->createForm(CategoryType::class,$category);
        $em=$this->getDoctrine()->getManager();

        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){

                $category->setName($form->get("name")->getData());
                $category->setDescription($form->get("description")->getData());

                $em->persist($category);
                $flush=$em->flush();

                if($flush==null){
                    $status="La categoria se ha creado correctamente";
                }else{
                    $status="Error al crear la categoria";
                }

                $this->session->getFlashBag()->add("status",$status);
                return $this->redirectToRoute("blog_index_category");
            }
        }

        return $this->render('BlogBundle:Category:add.html.twig', [
            "form"=>$form->createView()
        ]);
    }

    public function indexAction(){

        $em=$this->getDoctrine()->getManager();
        $categories=$em->getRepository(Category::class)->findAll();

        return $this->render('BlogBundle:Category:index.html.twig',[
            "categories"=>$categories
        ]);
    }


    public function deleteAction($id){
        $em=$this->getDoctrine()->getManager();
        $category=$em->getRepository(Category::class)->find($id);

        $em->remove($category);

        $em->flush();

        return $this->redirectToRoute("blog_index_category");
    }

    public function editAction($id,Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $category=$em->getRepository(Category::class)->find($id);
        
        $form=$this->createForm(CategoryType::class,$category);

        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){

                $category->setName($form->get("name")->getData());
                $category->setDescription($form->get("description")->getData());

                $em->persist($category);
                $flush=$em->flush();

                if($flush==null){
                    $status="La categoria se ha modificado correctamente";
                }else{
                    $status="Error al modificar la categoria";
                }

                $this->session->getFlashBag()->add("status",$status);
                return $this->redirectToRoute("blog_index_category");
            }
        }

        return $this->render('BlogBundle:Category:edit.html.twig', [
            "form"=>$form->createView()
        ]);
    }

}
