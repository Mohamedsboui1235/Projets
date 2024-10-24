<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Evenement
 *
 * @ORM\Table(name="evenement")
 * @ORM\Entity
 */
class Evenement
{
    /**
     * @var int
     *
     * @ORM\Column(name="idEvent", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idevent;

    /**
     * @var string
     *
     * @ORM\Column(name="NomEvent", type="string", length=255, nullable=false)
     * @Assert\NotBlank()
     */
    private $nomevent;

    /**
     * @var string
     *
     * @ORM\Column(name="AdresseEvent", type="string", length=255, nullable=false)
     * @Assert\NotBlank()
     */
    private $adresseevent;

    /**
     * @var int
     *
     * @ORM\Column(name="CapaciteEvent", type="integer", nullable=false)
     * @Assert\NotBlank()
     * @Assert\Range(min=100, max=1000)
     */
    private $capaciteevent;

    /**
     * @var int
     *
     * @ORM\Column(name="nbrTicketdispo", type="integer", nullable=false)
     * @Assert\NotBlank()
     * @Assert\Range(min=100, max=1000)
     */
    private $nbrticketdispo;

    /**
     * @var string
     *
     * @ORM\Column(name="DateDebutEvent", type="string", length=255, nullable=false)
     * @Assert\NotBlank()
     */
    private $datedebutevent;

    /**
     * @var string
     *
     * @ORM\Column(name="DateFinEvent", type="string", length=255, nullable=false)
     * @Assert\NotBlank()
     */
    private $datefinevent;

/**
 * @var string
 *
 * @ORM\Column(name="DescriptionEvent", type="string", length=255, nullable=true, options={"default"="NULL"})
 * @Assert\NotBlank()
 * @Assert\Length(
 *      min = 20
 * )
 */
private $descriptionevent;


    /**
     * @var float
     *
     * @ORM\Column(name="PrixEntre", type="float", precision=10, scale=0, nullable=false)
     * @Assert\NotBlank()
     * @Assert\Range(min=50, max=150)
     */
    private $prixentre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $image = 'NULL';

    public function getIdevent(): ?int
    {
        return $this->idevent;
    }

    public function getNomevent(): ?string
    {
        return $this->nomevent;
    }

    public function setNomevent(string $nomevent): self
    {
        $this->nomevent = $nomevent;

        return $this;
    }

    public function getAdresseevent(): ?string
    {
        return $this->adresseevent;
    }

    public function setAdresseevent(string $adresseevent): self
    {
        $this->adresseevent = $adresseevent;

        return $this;
    }

    public function getCapaciteevent(): ?int
    {
        return $this->capaciteevent;
    }

    public function setCapaciteevent(int $capaciteevent): self
    {
        $this->capaciteevent = $capaciteevent;

        return $this;
    }

    public function getNbrticketdispo(): ?int
    {
        return $this->nbrticketdispo;
    }

    public function setNbrticketdispo(int $nbrticketdispo): self
    {
        $this->nbrticketdispo = $nbrticketdispo;

        return $this;
    }

    public function getDatedebutevent(): ?string
    {
        return $this->datedebutevent;
    }

    public function setDatedebutevent(string $datedebutevent): self
    {
        $this->datedebutevent = $datedebutevent;

        return $this;
    }

    public function getDatefinevent(): ?string
    {
        return $this->datefinevent;
    }

    public function setDatefinevent(string $datefinevent): self
    {
        $this->datefinevent = $datefinevent;

        return $this;
    }

    public function getDescriptionevent(): ?string
    {
        return $this->descriptionevent;
    }

    public function setDescriptionevent(?string $descriptionevent): self
    {
        $this->descriptionevent = $descriptionevent;

        return $this;
    }

    public function getPrixentre(): ?float
    {
        return $this->prixentre;
    }

    public function setPrixentre(float $prixentre): self
    {
        $this->prixentre = $prixentre;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function __toString()
    {
        return (string) $this->nomevent;
    }


}
