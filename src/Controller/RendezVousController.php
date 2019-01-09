<?php

namespace App\Controller;

use App\Entity\Appointment;
use App\Entity\Member;
use App\Entity\Prestationtemplate;

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
use Symfony\Component\Validator\Constraints\DateTime;

class RendezVousController extends Controller
{
    /**
     * @Route("/rendezVous")
     */

    public function rendezVous(Request $request)
    {
        $session=$this->get('session');

        $entityManager = $this->getDoctrine()->getManager();

        $appointment = new Appointment();
        $form = $this->createFormBuilder($appointment)
            ->add('MemberName', TextType::class)
            ->add('MemberMail', TextType::class)
            ->add('MemberFirstName', TextType::class)
            ->add('prestationtemplateHair', ChoiceType::class, array(
                'choices' => array(
                    'Ras' => 1,
                    'Mi-long' => 2,
                    'Long' => 3,
                ),
            ))
            ->add('prestationTemplateSize', ChoiceType::class, array(
                'choices' => array(
                    'Très petit' => 1,
                    'Petit' => 2,
                    'Moyen' => 3,
                    'Grand' => 4,
                    'Très Grand' => 5,
                ),
            ))
            ->add('appointmentStart', TextType::class)
            ->add('save', SubmitType::class)
            ->getForm();
        
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $appointment = $form->getData();

            try
            {
                if($appointment != null)
                {
                    $repo = $entityManager->getRepository(Member::class);

                    $member = $repo->findOneBy(['memberMail' => $appointment->getMemberMail()]);

                    $appointment->setMember($member);
                    $appointment->setAppointmentDuration(15.0);
                    $appointment->setAppointmentPrice(15.0);

                    $aa = $entityManager->getRepository(Prestationtemplate::class);
                    $prestationTemplate = $aa->findOneBy(['prestationtemplateHair' => "RAS", 'prestationtemplateSize' => "TPETIT", 'prestationtemplateVersion' => 1]); 
                    $appointment->setPrestationTemplate($prestationTemplate);

                    $entityManager->persist($appointment);
                    $entityManager->flush();

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
}
?>