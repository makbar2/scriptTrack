<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    /**
     * this controller will run in a seperate thread
     * this find the orders that need to go out and then send the emaills
     *
     * Automatic prescription ordering wont be possible, as people dont update w
     */


    public function sendOrders()
    {

    }







}
