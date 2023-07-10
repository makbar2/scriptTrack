<?php

namespace App\Form;

use App\Entity\Patient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName',TextType::class,[
                "attr" => [

                ],


            ])
            ->add('surname',TextType::class,[
                "attr" => [

                ],


            ])
            ->add('dob',DateType::class,[
                "attr" => [

                ],


            ])
            ->add('collectionDate',DateType::class,[
                "attr" => [

                ],


            ])
            ->add('orderDate',DateType::class,[
                "attr" => [

                ],


            ])
            ->add('orderFrequency',IntegerType::class,[
                "attr" => [

                ],


            ])
            ->add('gpEmail',EmailType::class,[
                "attr" => [

                ],


            ])
            ->add("orderInformation",HiddenType::class,[
                "mapped" => false,

            ])
            ->add("save",SubmitType::class,[
                "attr" => [

                ],

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Patient::class,
        ]);
    }
}
