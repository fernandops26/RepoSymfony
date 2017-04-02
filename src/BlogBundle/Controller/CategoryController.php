<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Category;
use BlogBundle\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoryController extends Controller
{
    public function addAction()
    {
        $category=new Category();
        $form=$this->createForm(CategoryType::class,$category);
        
        return $this->render('BlogBundle:Category:add.html.twig', [
            "form"=>$form->createView()
        ]);
    }

}
