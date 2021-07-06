<?php
namespace App\Form;

use App\Entity\User;
use App\Entity\Paquet;
use App\Entity\AgentPoste;
use App\Entity\Poste;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaquetType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('type')
        ->add('designation')


        

        ->add('posteArrive', EntityType::class,[
           
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
            'data_class' => Paquet::class,
        ]);
    }
}
