<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Feature
 *
 * @ORM\Table(name="feature")
 * @ORM\Entity
 */
class Feature
{
    /**
     * @var int
     *
     * @ORM\Column(name="FEATURE_ID", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $featureId;

    /**
     * @var string
     *
     * @ORM\Column(name="FEATURE_LIB", type="string", length=255, nullable=false)
     */
    private $featureLib;

    public function getFeatureId(): ?int
    {
        return $this->featureId;
    }

    public function getFeatureLib(): ?string
    {
        return $this->featureLib;
    }

    public function setFeatureLib(string $featureLib): self
    {
        $this->featureLib = $featureLib;

        return $this;
    }


}
?>