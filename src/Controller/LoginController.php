<?php

namespace App\Controller;

use App\Entity\Member;
use App\Controller\PDO;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class LoginController extends AbstractController
{
    /**
     * @Route("/login")
     */

    use PDO;
    public function login(Request $request)
    {
        $member = new Member();

        $form = $this->createFormBuilder($member)
            ->add('MemberMail', TextType::class)
            ->add('Password', PasswordType::class)
            ->add('save', SubmitType::class, array('label' => 'Connexion', 'attr' =>  array('class' => 'btn btn-lg btn-primary btn-block' )))
            ->getForm();
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $member = $form->getData();

            $pdo = PDO::getInstance();
            $req = $pdo->prepare("SELECT MEMBER_MAIL
                                        ,MEMBER_PASSWORD
                                        FROM doupoils.member
                                WHERE MEMBER_MAIL = :MAIL");
            $req->bindValue(':MAIL', $member->getMemberMail());
            $req->execute();

            $stmt = $req->fetch($pdo::FETCH_ASSOC);

            if(($member->getMemberMail() == $stmt['MEMBER_MAIL']) && ($member->getPassword() == $stmt['MEMBER_PASSWORD']))
            {
                return $this->redirectToRoute('memberSpace');
            }
            
        }
        return $this->render('login.html.twig', array('form' => $form->createView(),));
	}
}
?>