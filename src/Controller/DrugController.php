<?php

namespace App\Controller;

use App\Entity\Drug;
use App\Repository\PatientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class DrugController extends AbstractController
{


    /**
     *  This ajax routes, don't have to be secured cus all they will return is just drug
     * entities... the only way this information would be useful to someone is if they
     * somehow find out a patient's full name ONLY !
     */

    #[Route("api/drugSuggestion",name:"getDrug",methods: "GET",)]//dunno if this is a good route name
    public function ajaxDrugs(Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($request->isXmlHttpRequest())
        {
            $name = $request->query->get("name");
            $drugs = $entityManager->getRepository(Drug::class)->searchName($name);
            $encoder = [new JsonEncoder()];
            $normalizers = [new ObjectNormalizer()];
            $serializer = new Serializer($normalizers,$encoder);
            $jsonContent = $serializer->serialize($drugs, 'json');
            $response = new Response($jsonContent);
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }
        return new Response("not seen as a http request");
    }


    //not needed
//    #[Route("api/patient/order",name:"getDrugOrder",methods: "GET",)]
//    public function getPatientDrugsOrder(Request $request,EntityManagerInterface $entityManager): Response
//    {
//        if($request->isXmlHttpRequest())
//        {
//            $patientID = $request->query->get("patientID");
//            $patient = $entityManager->getRepository(PatientRepository::class)->find($patientID);
//            $p
//            $encoder = [new JsonEncoder()];
//            $normalizers = [new ObjectNormalizer()];
//            $serializer = new Serializer($normalizers,$encoder);
//            $jsonContent = $serializer->serialize($drugs, 'json');
//            //code to get the patient's drug order
//            //
//        }else{
//
//        }
//    }


}
