<?php

namespace App\Controller\EventListener;

use App\Entity\Appointment;
use Toiba\FullCalendarBundle\Entity\Event;
use Toiba\FullCalendarBundle\Event\CalendarEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraints\DateTime;

class FullCalendarListener 
{

    /**
     * @var EntityManagerInterface
     */

     private $entityManager;

    public function __construct(EntityManagerInterface $em)
    {
        $this->entityManager = $em;
    }

    public function loadEvents(CalendarEvent $calendar)
    {
        $startDate = $calendar->getStart();
        $endDate = $calendar->getEnd();
        $filters = $calendar->getFilters();

        $appointments = $this->entityManager->getRepository(Appointment::class)->findAll();

        $Events = array();
        
        try{
            foreach($appointments as $appointment)
            {
                $tempsPrestation = $appointment->getAppointmentDuration();

                $dateDebut = new \DateTime($appointment->getAppointmentStart());

                $heureDebut = $dateDebut->format('H:i:s');

                $heureFinale = $this->HeureDeFinEstimee($tempsPrestation, $heureDebut);

                $date = $dateDebut->format('Y-m-d');

                $dateFinale = $date." ".$heureFinale;

                $Finale = \DateTime::createFromFormat('Y-m-d H:i:s', $dateFinale);

                dump($Finale);
                
                $calendar->addEvent(new Event('Rendez-vous', $dateDebut, $Finale));
                
                
            }
        }
        catch(Exception $e)
        {
            dump($e);
        }
    }

    public function HeureDeFinEstimee($tempsPrestation, $heureDebut)
    {
        $minutePrestation = $tempsPrestation % 60;
        $hourPrestation = floor($tempsPrestation/60);

        $heureCalcul = explode(":", $heureDebut);

        $heureFinale = $hourPrestation + intval($heureCalcul[0]);
        $minuteFinale = $minutePrestation + intval($heureCalcul[1]);

        $heureFinale = floor($minuteFinale/60) + $heureFinale;
        $minuteFinale = $minuteFinale%60;

        
        if(strlen($heureFinale) < 2)
            $heureFinale = "0{$heureFinale}";

        if(strlen($minuteFinale) < 2)
            $minuteFinale = "0{$minuteFinale}";

        // if(strlen($second) < 2)
        //     $second = "0{$second}";

        return $heureFinale.":".$minuteFinale.":00";
    }
}
?>