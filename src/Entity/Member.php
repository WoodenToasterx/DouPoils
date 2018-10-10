<?php

namespace App\Entity;

class Member
{
    protected $memberMail;
    protected $password;

    public function getMemberMail()
    {
        return (string)$this->memberMail;
    }
    public function setMemberMail($mail)
    {
        $this->memberMail = $mail;
    }

    public function getPassword()
    {
        return (string)$this->password;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
}

?>