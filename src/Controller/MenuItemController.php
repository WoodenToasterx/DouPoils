<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MenuItemController extends AbstractController
{
    /**
     * @Route("/")
     */

    public function menu()
    {
        return $this->render('accueil.html.twig');
	}
}
?>