<?php

namespace App\Components;

use App\Repository\PatientRepository;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
#[AsLiveComponent]
class PatientSearch
{
    use DefaultActionTrait;

    #[LiveProp(writable: true)]
    public string $query = '';

    public function __construct(private PatientRepository $patientRepository)
    {

    }



    public function getPatients():array
    {
        $regex = '/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/\d{4}$/';
        if(preg_match($regex,$this->query))//check if the user entered a dob or not
        {
            return $this->patientRepository->findBy(["dob" => $this->query]);
        }else
        {
            return $this->patientRepository->searchBySurname($this->query);
        }
    }


    /*
     * checks to see if the query matches the regex for dob,
     * returns true if dob is found
     */


}