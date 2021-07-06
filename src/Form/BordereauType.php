<?php
namespace App\Form;
use App\Entity\Paquet;
use App\Entity\Livreur;
use App\Entity\Poste;
use App\Entity\Camion;

use App\Entity\Bordereau;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class BordereauType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
     



        ->add('livreur', EntityType::class,[
           
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
              

           
        ->add('PosteArrive', EntityType::class,[
           
            'class'=> Poste::class,
            'choice_label'=>'nomPoste',
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
            'data_class' => Bordereau::class,
        ]);
    }
}
