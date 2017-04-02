<?php

namespace BlogBundle\Form;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AuthorType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,["required"=>"required","attr"=>["class"=>"ui input"]])
            ->add('surname',TextType::class,["required"=>"required","attr"=>["class"=>"ui input"]])
            ->add('email',TextType::class,["required"=>"required","attr"=>["class"=>"ui input"]])
            ->add('password',PasswordType::class,["required"=>"required","attr"=>["class"=>"ui input"]])
            ->add('Save',SubmitType::class,["attr"=>["class"=>"ui button"]]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BlogBundle\Entity\Author'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'blogbundle_author';
    }


}
