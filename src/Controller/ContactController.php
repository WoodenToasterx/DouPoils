<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact")
     */

    public function contact()
    {
        return $this->render('contact.html.twig');
    }
    
    
}
?>