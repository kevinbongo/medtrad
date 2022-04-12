<?php

namespace App\Entity;

use App\Repository\MessagecontactRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MessagecontactRepository::class)
 */
class Messagecontact
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nomprenomenvoyeur;

    /**
     * @ORM\Column(type="string", length=75)
     */
    private $emailenvoyeur;

    /**
     * @ORM\Column(type="text")
     */
    private $textmessage;

    /**
     * @ORM\Column(type="integer")
     */
    private $numeroenvoyeur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomprenomenvoyeur(): ?string
    {
        return $this->nomprenomenvoyeur;
    }

    public function setNomprenomenvoyeur(string $nomprenomenvoyeur): self
    {
        $this->nomprenomenvoyeur = $nomprenomenvoyeur;

        return $this;
    }

    public function getEmailenvoyeur(): ?string
    {
        return $this->emailenvoyeur;
    }

    public function setEmailenvoyeur(string $emailenvoyeur): self
    {
        $this->emailenvoyeur = $emailenvoyeur;

        return $this;
    }

    public function getTextmessage(): ?string
    {
        return $this->textmessage;
    }

    public function setTextmessage(string $textmessage): self
    {
        $this->textmessage = $textmessage;

        return $this;
    }

    public function getNumeroenvoyeur(): ?int
    {
        return $this->numeroenvoyeur;
    }

    public function setNumeroenvoyeur(int $numeroenvoyeur): self
    {
        $this->numeroenvoyeur = $numeroenvoyeur;

        return $this;
    }
}
