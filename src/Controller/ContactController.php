<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact")
     */

    public function contact(Request $request, \Swift_Mailer $mailer)
    {
        $session=$this->get('session');

        $defaultData = array('message' => 'Type your message');

        $form = $this->createFormBuilder($defaultData)
            ->add('Name', TextType::class)
            ->add('Email', TextType::class)
            ->add('Message', TextareaType::class)
            ->add('Save', SubmitType::class, array('label' => 'Valider', 'attr' =>  array('class' => 'btn btn-primary' )))
            ->getForm();
        
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $contacter = $form->getData();

            try
            {
                $message = (new \Swift_Message('Hello Email'))
                ->setFrom([$contacter['Email'] => $contacter['Name']])
                ->setTo('example@gmail.com')
                ->setBody($contacter['Message']);

                $mailer->send($message);

                return $this->redirectToRoute('contact');
            }
            catch(Exception $e)
            {
                
            }
        }

        return $this->render('contact.html.twig', array('form' => $form->createView(),));
    }
}
?>