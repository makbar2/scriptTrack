<?php

namespace App\Controller;

use App\Entity\Drug;
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

    #[Route("api/drug",name:"getDrug",methods: "GET",)]//dunno if this is a good route name
    public function ajaxDrugs(Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($request->isXmlHttpRequest())
        {
            $name = $request->query->get("name");
            $drugs = $entityManager->getRepository(Drug::class)->searchName($name);
            $response = new Response(json_encode($drugs));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }
        return new Response("not seen as a http request");
    }



    #[Route("api/patient/order",name:"getDrugOrder",methods: "GET",)]
    public function getPatientDrugsOrder(Request $request): Response
    {
        if($request->isXmlHttpRequest())
        {
            $patientID = $request->query->get("patientID");
            //code to get the patient's drug order
            //
        }else{

        }
    }
}
