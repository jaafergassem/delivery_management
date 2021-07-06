<?php
namespace App\Form;

use App\Entity\Livreur;

use App\Entity\Camion;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AffecterType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
    
      

        ->add('nom', EntityType::class,[
           
            'class'=> Livreur::class,
            'choice_label'=>'nom',
            'expanded'=>FALSE,
            'multiple'=>FALSE,
        ])

  

        ->add('camion', EntityType::class,[
           
            'class'=> Camion::class,
            'choice_label'=>'matriculeCamion',
            'expanded'=>FALSE,
            'multiple'=>FALSE,
        ])
        ;
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Livreur::class,
        ]);
    }
}
