<?php

namespace App\Controller;
use App\Entity\Drug;
use App\Entity\Patient;
use App\Form\PatientType;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;



class PatientController extends AbstractController
{


    /**
     * Patient form to add patient or edit their details on the system. The data on this page is then used to create
     * the order that will be sent to their GP.
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param int|null $id
     * @return Response
     */
    #[Route("/patient/form/{id}",name: "patientForm")]
    public function patientForm(Request $request,EntityManagerInterface $entityManager,int $id=null ):Response
    {
        if($id != null)
        {
            try
            {
                $patient = $entityManager->getRepository(Patient::class)->find($id);
            }catch(\Exception $e)
            {
                $patient = new Patient();
            }
        }else
        {
            $patient = new Patient();
        }
        $form = $this->createForm(PatientType::class,$patient);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            if($id == null)//inefficient
            {
                $patient = $form->getData();
                $entityManager->persist($patient);
                $entityManager->flush($patient);
            }else
            {
            }
        }
        return $this->render("patient/form.html.twig",
            [
                "form" => $form,
                "patient"  => $patient
            ]);
    }

    #[Route("patient/search", name:"patientSearch")]
    public function searchPatient(EntityManagerInterface $entityManager)
    {
        return $this->render("patient/index.html.twig",
            [

            ]);
    }
}
