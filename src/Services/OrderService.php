<?php

namespace App\Services;

use App\Entity\Drug;
use App\Entity\Order;
use App\Entity\Patient;

use Doctrine\ORM\EntityManagerInterface;


class OrderService
{


    /**
     * @param Patient $patient
     * @param array $drugIds
     * this should be what the patients wants to order,every item in this list is waht they want to order
     * it needs to be checked against the orders table and records need to be modified accordingly
     * @param EntityManagerInterface $entityManager
     * @return void
     */
    public function processOrder(Patient $patient, array $drugIds, EntityManagerInterface $entityManager): void
    {
        $inputtedDrugs = $this->getDrugs($drugIds,$entityManager);
        if(!$patient->getOrders()->isEmpty())
        {
            $patientDrugs = $this->getPatientDrugs($patient);
            $patientDrugIDs = $this->getIDs($patientDrugs);
            $inputtedDrugIDs = $this->getIDs($inputtedDrugs);
            $newDrugsIDs  = array_diff($inputtedDrugIDs,$patientDrugIDs);//life saver
            $drugsToRemoveIDs = array_diff($patientDrugIDs,$inputtedDrugIDs);//ones to remove from the order
            foreach($newDrugsIDs as $newDrugID)
            {
                $newDrug = $entityManager->getRepository(Drug::class)->find($newDrugID);
                $this->addToOrder($patient,$newDrug,$entityManager);
            }
            foreach ($drugsToRemoveIDs as $drugID)
            {
                $drug = $entityManager->getRepository(Drug::class)->find($drugID);
                $this->removeFromOrder($patient,$drug,$entityManager);
            }
        }else{
            foreach ($inputtedDrugs as $drug)
            {
                $this->addToOrder($patient,$drug,$entityManager);
            }
        }
    }

    private function addToOrder(Patient $patient,Drug $drug,EntityManagerInterface $entityManager): void
    {
        $order = new Order();
        $order->setDrug($drug);
        $patient->addOrder($order);
        $entityManager->persist($order);
        $entityManager->flush();
    }




    public function removeFromOrder(Patient $patient,Drug $drug,EntityManagerInterface $entityManager):void
    {
        $order = $entityManager->getRepository(Order::class)->selectOrder($patient,$drug);//its this or a nested loop i think this would be faster
        $patient->removeOrder($order[0]);
        $entityManager->flush();
    }

    //turn the id array into drug array
    private function getDrugs(array $drugIds,EntityManagerInterface $entityManager): array
    {
        $newDrugs = [];

        foreach ($drugIds as $id)
        {
            $newDrugs[] = $entityManager->getRepository(Drug::class)->find($id);
        }
        return $newDrugs;
    }


    public function getPatientDrugs(Patient $patient): array
    {
        $drugArray = [];
        $orders = $patient->getOrders();
        foreach($orders as $order)
        {
            $drugArray[] = $order->getDrug();

        }
        return $drugArray;
    }

    private function getIDs(array $drugArray):array
    {
        $ids = [];
        foreach ($drugArray as $drug)
        {
            $ids[] = $drug->getID();
        }
        return $ids;
    }


    /**]
     *  move this later, rn i am putting this here so that you can manually sned the order
     *  code bellow is part of this functionality
     *  later will be moved into the command class,
     * @return void
     */
    public function sendOrder()
    {

    }

    public function sendMail()
    {

    }


}