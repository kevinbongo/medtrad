<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;


class Contact
{
    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=2,max=100)
     */
    private $nomprenom;
    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=10,max=10)
     */
    private $telephone;
    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @var string|null
     * @Assert\NotBlank()
     */
    private $message;


    function getNomprenom(): ?string
    {
        return $this->nomprenom;
    }
    function getTelephone(): ?string
    {
        return $this->telephone;
    }


    function getEmail(): ?string
    {
        return $this->email;
    }

    function getMessage(): ?string
    {
        return $this->message;
    }

    function setNomprenom(?string $nomprenom): self
    {
        $this->nomprenom = $nomprenom;
        return $this;
    }
    function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;
        return $this;
    }
    function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }

    function setMessage(?string $message): self
    {
        $this->message = $message;
        return $this;
    }
}
