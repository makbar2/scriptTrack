<?php

namespace App\Controller;
use App\Entity\Drug;
use App\Entity\Patient;
use App\Form\PatientType;
use App\Services\OrderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;



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
    #[Route("/form/patient/{id}",name: "patientForm")]
    public function patientForm(Request $request,EntityManagerInterface $entityManager,OrderService $orderService,int $id=null ):Response
    {
        /**
         * this is a mess idk how to make it better, due to the fact that i some ajax with this form
         * so i have a hidden field that isnt mapped to patient that will have its data changed based
         * on the live search for what they want to order
         * this fucking sucks
         *
         */
        $error = null;
        $orders = null;
        if($id != null)
        {
            $patient = $entityManager->getRepository(Patient::class)->find($id);
            try
            {
                $patient = $entityManager->getRepository(Patient::class)->find($id);
                $drugs = $orderService->getPatientDrugs($patient);
            }catch(\Exception $e)
            {
                $patient = new Patient();
                $error = "no patient found";
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
                "patient"  => $patient,
                "orders" => $orders,
                "error" => $error
            ]);
    }

    #[Route("patient/search", name:"patientSearch")]
    public function searchPatient(EntityManagerInterface $entityManager):Response
    {
        return $this->render("patient/index.html.twig",
            [

            ]);
    }

    #[Route("/", name:"testing")]
    public function test(EntityManagerInterface $entityManager,OrderService $orderService)
    {
        $patient = $entityManager->getRepository(Patient::class)->find(1);
        $orderService->processOrder($patient,[1003,1004],$entityManager);
        return $this->render("test.html.twig",[
            "patient" => $patient,

        ]);
    }









}
