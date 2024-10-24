<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Ticket
 *
 * @ORM\Table(name="ticket")
 * @ORM\Entity
 */
class Ticket
{
    /**
     * @var int
     *
     * @ORM\Column(name="IdTicket", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idticket;

    /**
     * @var string
     *
     * @ORM\Column(name="NomClient", type="string", length=255, nullable=false)
     * @Assert\NotBlank()
     */
    private $nomclient;

    /**
     * @var float
     *
     * @ORM\Column(name="PrixTicket", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixticket;

    /**
     * @var string
     *
     * @ORM\Column(name="NomEvent", type="string", length=255, nullable=false)
     */
    private $nomevent;

    /**
     * @var int
     *
     * @ORM\Column(name="nbr_ticket", type="integer", nullable=false)
     * @Assert\NotBlank()
     * @Assert\Range(min=1, max=10)
     */
    private $nbrTicket;

    /**
     * @var \Evenement
     *
     * @ORM\ManyToOne(targetEntity="Evenement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_event", referencedColumnName="idEvent")
     * })
     */
    private $event;

    public function getIdticket(): ?int
    {
        return $this->idticket;
    }

    public function getNomclient(): ?string
    {
        return $this->nomclient;
    }

    public function setNomclient(string $nomclient): self
    {
        $this->nomclient = $nomclient;

        return $this;
    }

    public function getPrixticket(): ?float
    {
        return $this->prixticket;
    }

    public function setPrixticket(float $prixticket): self
    {
        $this->prixticket = $prixticket;

        return $this;
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

    public function getNbrTicket(): ?int
    {
        return $this->nbrTicket;
    }

    public function setNbrTicket(int $nbrTicket): self
    {
        $this->nbrTicket = $nbrTicket;

        return $this;
    }

    public function getEvent(): ?Evenement
    {
        return $this->event;
    }

    public function setEvent(?Evenement $event): self
    {
        $this->event = $event;

        return $this;
    }


}