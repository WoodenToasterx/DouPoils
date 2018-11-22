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
use Symfony\Component\Form\Extension\Core\Type\DateType;

class RendezVousController extends Controller
{
    /**
     * @Route("/rendezVous")
     */

    public function rendezVous(Request $request)
    {
        $appointment = new Appointment();
        $form = $this->createFormBuilder($appointment)
            ->add('MemberName', TextType::class)
            ->add('MemberFirstName', TextType::class)
            ->add('MemberMail', TextType::class)
            ->add('TailleChien', TextType::class)
            ->add('PoilChien', TextType::class)
            ->add('StartDate', DateType::class)
            ->add('EndDate', DateType::class)
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
                return $this->redirectToRoute('rendezVous');
                //$this->addAction($appointment->getMemberMail());
                //problem call function to function
            }
            
        }

        return $this->render('rendez_vous.html.twig', array('form' => $form->createView(),));
    }

    // /**
    //  * @Route("/rendezVous/{appointment}")
    //  */
    
    //  public function addAction($appointment)
    //  {
    //     var_dump($appointment);
    //     if($appointment == "aaa")
    //     {
    //         return $this->redirectToRoute('contact');
    //     }
        
    //     return;
    //  }
}
?>