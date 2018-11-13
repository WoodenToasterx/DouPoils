<?php

namespace App\Controller;

use App\Entity\Appointment;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;


use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RendezVousController extends Controller
{
    /**
     * @Route("/rendezVous")
     */

    public function rendezVous(Request $request)
    {
        $appointment = new Appointment();
        $form = $this->createFormBuilder($appointment)
            ->add('MemberMail', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Valider', 'attr' =>  array('class' => 'btn btn-primary' )))
            ->getForm();
        
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $appointment = $form->getData();
            try
            {
                $appointment->getMemberMail();

            }
            catch(Exception $e)
            {
                var_dump($e);
            }

            if(($appointment->getMemberMail() == "aaa"))
            {
                $this->addAction($appointment->getMemberMail());
                //problem call function to function
            }
            
        }

        return $this->render('rendez_vous.html.twig', array('form' => $form->createView(),));
    }
    
     public function addAction(string $member)
     {
        if($member != "aaa")
        {
            return $this->redirectToRoute('contact');
        }
        
        
     }
}
?>