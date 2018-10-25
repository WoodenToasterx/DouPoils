<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;

class RendezVousController extends AbstractController
{
    /**
     * @Route("/rendezVous")
     */

    public function rendezVous()
    {
        return $this->render('rendez_vous.html.twig');
    }
    
    
}
?>