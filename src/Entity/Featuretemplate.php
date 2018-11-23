<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Featuretemplate
 *
 * @ORM\Table(name="featuretemplate", indexes={@ORM\Index(name="IDX_D23F65F75336E3A6", columns={"FEATURE_ID"})})
 * @ORM\Entity
 */
class Featuretemplate
{
    /**
     * @var int
     *
     * @ORM\Column(name="FEATURETEMPLATE_VERSION", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $featuretemplateVersion;

    /**
     * @var string
     *
     * @ORM\Column(name="FEATURETEMPLATE_DURATION", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $featuretemplateDuration;

    /**
     * @var string
     *
     * @ORM\Column(name="FEATURETEMPLATE_PRICE", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $featuretemplatePrice;

    /**
     * @var \Feature
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Feature")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FEATURE_ID", referencedColumnName="FEATURE_ID")
     * })
     */
    private $feature;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Appointment", mappedBy="feature")
     */
    private $appointment;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->appointment = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getFeaturetemplateVersion(): ?int
    {
        return $this->featuretemplateVersion;
    }

    public function getFeaturetemplateDuration()
    {
        return $this->featuretemplateDuration;
    }

    public function setFeaturetemplateDuration($featuretemplateDuration): self
    {
        $this->featuretemplateDuration = $featuretemplateDuration;

        return $this;
    }

    public function getFeaturetemplatePrice()
    {
        return $this->featuretemplatePrice;
    }

    public function setFeaturetemplatePrice($featuretemplatePrice): self
    {
        $this->featuretemplatePrice = $featuretemplatePrice;

        return $this;
    }

    public function getFeature(): ?Feature
    {
        return $this->feature;
    }

    public function setFeature(?Feature $feature): self
    {
        $this->feature = $feature;

        return $this;
    }

    /**
     * @return Collection|Appointment[]
     */
    public function getAppointment(): Collection
    {
        return $this->appointment;
    }

    public function addAppointment(Appointment $appointment): self
    {
        if (!$this->appointment->contains($appointment)) {
            $this->appointment[] = $appointment;
            $appointment->addFeature($this);
        }

        return $this;
    }

    public function removeAppointment(Appointment $appointment): self
    {
        if ($this->appointment->contains($appointment)) {
            $this->appointment->removeElement($appointment);
            $appointment->removeFeature($this);
        }

        return $this;
    }

}

?>
