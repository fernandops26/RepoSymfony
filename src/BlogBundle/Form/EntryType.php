<?php

namespace BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class EntryType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',TextType::class,["required"=>"required","attr"=>["class"=>"ui input"]])
            ->add('content',TextareaType::class,["required"=>"required","attr"=>["class"=>"ui texarea"]])
            ->add('status',ChoiceType::class,["required"=>"required","choices"=>["Public"=>"public","Private"=>"private"]])
            ->add('image',FileType::class,["data_class"=>null])
            ->add('category',EntityType::class,["class"=>"BlogBundle\Entity\Category"])
            ->add('tags',TextType::class,["mapped"=>false,"required"=>"required","attr"=>["placeholder"=>"Enter Tags"]])
            ->add('Save',SubmitType::class,["attr"=>["class"=>"ui button"]]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BlogBundle\Entity\Entry'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'blogbundle_entry';
    }


}
