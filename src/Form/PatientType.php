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
                    "class" => "form-control"
                ],


            ])
            ->add('surname',TextType::class,[
                "attr" => [
                    "class" => "form-control"
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
                    "class" => "form-control"
                ],


            ])
            ->add('gpEmail',EmailType::class,[
                "attr" => [
                    "class" => "form-control"
                ],


            ])
            ->add("save",SubmitType::class,[
                "attr" => [
                    "class" => "btn btn-primary"
                ],

            ])
            ->add("orderInformation",HiddenType::class,[
                "mapped" => false
            ])//will contain the drug information
            ->add("name",TextType::class,[
                "mapped" => false,
                "label" => "Enter drugs",
                "attr" =>
                [
                    "onkeydown" => "getDrug(this.value)",
                    "class" => "form-control"
                ]
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
