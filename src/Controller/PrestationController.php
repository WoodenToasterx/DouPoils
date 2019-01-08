<?php

namespace App\Controller;

use App\Entity\Prestationtemplate;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PrestationController extends AbstractController
{
    /**
     * @Route("/prestation")
     */

     public function Prestation()
     {
        $session=$this->get('session');

        $entityManager = $this->getDoctrine()->getManager();

        $repo = $entityManager->getRepository(Prestationtemplate::class);
        $prestationTemplateList = $repo->findAll();

        return $this->render('prestation.html.twig',  array('prestationList' => $prestationTemplateList));
     }
}
?>