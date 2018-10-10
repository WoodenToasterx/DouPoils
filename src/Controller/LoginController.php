<?php

namespace App\Controller;

use App\Entity\Member;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class LoginController extends AbstractController
{
    /**
     * @Route("/login")
     */

    public function login(Request $request)
    {
        $member = new Member();

        $form = $this->createFormBuilder($member)
            ->add('MemberMail', TextType::class)
            ->add('Password', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Login' ))
            ->getForm();
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $member = $form->getData();
            
            if($member->getMemberMail() == "monizvalentine@yahoo.fr")
            {
                echo('youhou');
            }
            
        }
        return $this->render('login.html.twig', array('form' => $form->createView(),));
	}
}
?>