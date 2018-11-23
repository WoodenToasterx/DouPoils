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
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

class RendezVousController extends Controller
{
    /**
     * @Route("/rendezVous")
     */
    //use PDO;
    public function rendezVous(Request $request)
    {
        $session=$this->get('session');
        // $pdo = PDO::getInstance();
        // $req = $pdo->prepare('SELECT DISTINCT PRESTATIONTEMPLATE_HAIR
        //                       FROM doupoils.prestationtemplate;');

        // $req->execute();
        // $stmt = $req->fetchAll($pdo::FETCH_ASSOC);

        $entityManager = $this->getDoctrine()->getManager();

        $appointment = new Appointment();
        $form = $this->createFormBuilder($appointment)
            ->add('MemberName', TextType::class)
            ->add('MemberMail', TextType::class)
            ->add('MemberFirstName', TextType::class)
            ->add('prestationtemplateHair', ChoiceType::class, array(
                'choices' => array(
                    'Très petit' => 1,
                    'Petit' => 2,
                    'Moyen' => 3,
                    'Grand' => 4,
                    'Très grand' => 5,
                ),
            ))
            
            ->add('appointmentStart', DateTimeType::class, array(
                'widget'=> 'single_text',
                'format' => 'dd-MM-yyyy',
                'input' => 'timestamp',
            ))
            // ->add('appointmentStart', TimeType::class, array(
            //     'widget' => 'choice',
            //     'input' => 'string',
            //     'view_timezone' => 'Europe/Paris',
            //     'placeholder' => 'Heure de rendez-vous',
            // ))
            ->add('save', SubmitType::class, array('label' => 'Valider', 'attr' =>  array('class' => 'btn btn-primary' )))
            ->getForm();
        
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $appointment = $form->getData();

            try
            {
                if(($session != null && $appointment->getMember()->getMemberMail() == $session->get('mail')))
                {
                    $pdo->beginTransaction();
                    $req = $pdo->prepare("INSERT INTO doupoils.appointment(
                         APPOINTMENT_START
                        ,APPOINTMENT_DURATION
                        ,APPOINTMENT_PRICE
                        ,MEMBER_ID
                        ,PRESTATIONTEMPLATE_HAIR
                        ,PRESTATIONTEMPLATE_SIZE
                        ,PRESTATIONTEMPLATE_VERSION) 
                    VALUES (
                         :startdate
                        ,:duration
                        ,:price
                        ,:id
                        ,:hair
                        ,:size
                        ,:prestationversion)");
                    
                    $req->bindValue(':startdate', $appointment->getStartDate()->getTimestamp());
                    $req->bindValue(':duration', 15.0 );
                    $req->bindValue(':price', 15.0 );
                    $req->bindValue(':id', 2);
                    $req->bindValue(':hair', "RAS");
                    $req->bindValue(':size', "TPETIT");
                    $req->bindValue(':prestationversion', 1);

                    $req->execute();

                    $pdo->commit();

                    return $this->redirectToRoute('rendezVous');
                }
            }
            catch(Exception $e)
            {
                if($pdo->inTransaction() != null)
                    $pdo->rollback();
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