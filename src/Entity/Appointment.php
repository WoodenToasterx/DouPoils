<?php

namespace App\Entity;

class Appointment
{
    protected $memberMail;
    protected $memberName;
    protected $memberFirstName;
    protected $tailleChien;
    protected $poilChien;
    protected $startDate;
    protected $startTime;
    protected $endDate;

    public function getMemberMail()
    {
        return (string)$this->memberMail;
    }
    
    public function setMemberMail($mail)
    {
        $this->memberMail = $mail;
    }

    public function getMemberName()
    {
        return (string)$this->memberName;
    }
    
    public function setMemberName($name)
    {
        $this->memberName = $name;
    }

    public function getMemberFirstName()
    {
        return (string)$this->memberFirstName;
    }

    public function setMemberFirstName($firstName)
    {
        $this->memberFirstName = $firstName;
    }

    public function getTailleChien()
    {
        return (string)$this->tailleChien;
    }

    public function setTailleChien($taille)
    {
        $this->tailleChien = $taille;
    }

    public function getPoilChien()
    {
        return (string)$this->poilChien;
    }

    public function setPoilChien($poil)
    {
        $this->poilChien = $poil;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function setStartDate($date)
    {
        $this->startDate = $date;
    }

    public function getStartTime()
    {
        return $this->startTime;
    }
    public function setStartTime($time)
    {
        $this->startTime = $time;
    }

    public function getEndDate()
    {
        return $this->endDate;
    }

    public function setEndDate($date)
    {
        $this->endDate = $date;
    }
}

?>