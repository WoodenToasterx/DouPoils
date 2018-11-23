<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Member
 *
 * @ORM\Table(name="member")
 * @ORM\Entity
 */
class Member
{
    /**
     * @var int
     *
     * @ORM\Column(name="MEMBER_ID", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $memberId;

    /**
     * @var string
     *
     * @ORM\Column(name="MEMBER_FIRSTNAME", type="string", length=30, nullable=false)
     */
    private $memberFirstname;

    /**
     * @var string
     *
     * @ORM\Column(name="MEMBER_NAME", type="string", length=50, nullable=false)
     */
    private $memberName;

    /**
     * @var string
     *
     * @ORM\Column(name="MEMBER_MAIL", type="string", length=60, nullable=false)
     */
    private $memberMail;

    /**
     * @var string
     *
     * @ORM\Column(name="MEMBER_PASSWORD", type="string", length=20, nullable=false)
     */
    private $memberPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="MEMBER_RIGHT", type="string", length=0, nullable=false)
     */
    private $memberRight;

    public function getMemberId(): ?int
    {
        return $this->memberId;
    }

    public function getMemberFirstname(): ?string
    {
        return $this->memberFirstname;
    }

    public function setMemberFirstname(string $memberFirstname): self
    {
        $this->memberFirstname = $memberFirstname;

        return $this;
    }

    public function getMemberName(): ?string
    {
        return $this->memberName;
    }

    public function setMemberName(string $memberName): self
    {
        $this->memberName = $memberName;

        return $this;
    }

    public function getMemberMail(): ?string
    {
        return $this->memberMail;
    }

    public function setMemberMail(string $memberMail): self
    {
        $this->memberMail = $memberMail;

        return $this;
    }

    public function getMemberPassword(): ?string
    {
        return $this->memberPassword;
    }

    public function setMemberPassword(string $memberPassword): self
    {
        $this->memberPassword = $memberPassword;

        return $this;
    }

    public function getMemberRight(): ?string
    {
        return $this->memberRight;
    }

    public function setMemberRight(string $memberRight): self
    {
        $this->memberRight = $memberRight;

        return $this;
    }


}
?>