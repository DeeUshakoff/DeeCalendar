<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
class HomeController extends AbstractController
{
    public function Home(){
        return new Response($this->render('home.twig') );
    }
}

