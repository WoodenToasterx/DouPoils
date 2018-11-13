<?php

namespace App\Entity;

class Appointment
{
    protected $memberMail;

    public function getMemberMail()
    {
        return (string)$this->memberMail;
    }
    
    public function setMemberMail($mail)
    {
        $this->memberMail = $mail;
    }
}

?>