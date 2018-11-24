<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints\DateTime;

use Doctrine\ORM\Mapping as ORM;

/**
 * Appointment
 *
 * @ORM\Table(name="appointment", indexes={@ORM\Index(name="FK_APPOINTMENT_MEMBER", columns={"MEMBER_ID"}), @ORM\Index(name="FK_APPOINTMENT_PRESTATIONTEMPLATE", columns={"PRESTATIONTEMPLATE_HAIR", "PRESTATIONTEMPLATE_SIZE", "PRESTATIONTEMPLATE_VERSION"})})
 * @ORM\Entity
 */
class Appointment
{
    /**
     * @var int
     *
     * @ORM\Column(name="APPOINTMENT_ID", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $appointmentId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="APPOINTMENT_START", type="string", nullable=false)
     */
    public $appointmentStart;

    /**
     * @var string
     *
     * @ORM\Column(name="APPOINTMENT_DURATION", type="integer", nullable=false)
     */
    private $appointmentDuration;

    /**
     * @var string
     *
     * @ORM\Column(name="APPOINTMENT_PRICE", type="integer", nullable=false)
     */
    private $appointmentPrice;

    /**
     * @var \Member
     *
     * @ORM\ManyToOne(targetEntity="Member")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="MEMBER_ID", referencedColumnName="MEMBER_ID")
     * })
     */
    private $member;

    private $memberName;
    private $memberFirstName;
    private $memberMail;

    /**
     * @var \Prestationtemplate
     *
     * @ORM\ManyToOne(targetEntity="Prestationtemplate")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="PRESTATIONTEMPLATE_HAIR", referencedColumnName="PRESTATIONTEMPLATE_HAIR"),
     *   @ORM\JoinColumn(name="PRESTATIONTEMPLATE_SIZE", referencedColumnName="PRESTATIONTEMPLATE_SIZE"),
     *   @ORM\JoinColumn(name="PRESTATIONTEMPLATE_VERSION", referencedColumnName="PRESTATIONTEMPLATE_VERSION")
     * })
     */
    private $prestationtemplate;

    private $prestationTemplateSize;
    private $prestationTemplateHair;
    private $prestationTemplateVersion;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Featuretemplate", inversedBy="appointment")
     * @ORM\JoinTable(name="have",
     *   joinColumns={
     *     @ORM\JoinColumn(name="APPOINTMENT_ID", referencedColumnName="APPOINTMENT_ID")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="FEATURE_ID", referencedColumnName="FEATURE_ID"),
     *     @ORM\JoinColumn(name="FEATURETEMPLATE_VERSION", referencedColumnName="FEATURETEMPLATE_VERSION")
     *   }
     * )
     */
    private $feature;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->feature = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getAppointmentId(): ?int
    {
        return $this->appointmentId;
    }

    public function getAppointmentStart()
    {
        return $this->appointmentStart;
    }

    public function setAppointmentStart($appointmentStart)
    {
        $this->appointmentStart = $appointmentStart;
        return $this;
    }

    public function getAppointmentDuration()
    {
        return $this->appointmentDuration;
    }

    public function setAppointmentDuration($appointmentDuration): self
    {
        $this->appointmentDuration = $appointmentDuration;

        return $this;
    }

    public function getAppointmentPrice()
    {
        return $this->appointmentPrice;
    }

    public function setAppointmentPrice($appointmentPrice): self
    {
        $this->appointmentPrice = $appointmentPrice;

        return $this;
    }

    public function getMember(): ?Member
    {
        return $this->member;
    }

    public function setMember(?Member $member): self
    {
        $this->member = $member;

        return $this;
    }

    public function getMemberName()
    {
        return $this->memberName;
    }

    public function setMemberName($memberLastName)
    {
        $this->memberName = $memberLastName;
    }

    public function getMemberFirstName()
    {
        return $this->memberFirstName;
    }

    public function setMemberFirstName($memberfirstName)
    {
        $this->memberFirstName = $memberfirstName;
    }

    public function getMemberMail()
    {
        return $this->memberMail;
    }

    public function setMemberMail($mail)
    {
        $this->memberMail = $mail;
    }

    public function getPrestationtemplateHair()
    {
        return $this->prestationTemplateHair;
    }

    public function setPrestationTemplateHair($hair)
    {
        $this->prestationTemplateHair = $hair;
    }

    public function getPrestationTemplateSize()
    {
        return $this->prestationTemplateSize;
    }

    public function setPrestationTemplateSize($size)
    {
        $this->prestationTemplateHair = $size;
    }

    public function getPrestationTemplateVersion()
    {
        return $this->prestationTemplateVersion;
    }

    public function setPrestationTemplateVersion($version)
    {
        $this->prestationTemplateVersion = $version;
    }

    public function setPrestationtemplate(?Prestationtemplate $prestationtemplate): self
    {
        $this->prestationtemplate = $prestationtemplate;

        return $this;
    }

    /**
     * @return Collection|Featuretemplate[]
     */
    public function getFeature(): Collection
    {
        return $this->feature;
    }

    public function addFeature(Featuretemplate $feature): self
    {
        if (!$this->feature->contains($feature)) {
            $this->feature[] = $feature;
        }

        return $this;
    }

    public function removeFeature(Featuretemplate $feature): self
    {
        if ($this->feature->contains($feature)) {
            $this->feature->removeElement($feature);
        }

        return $this;
    }
}
?>
