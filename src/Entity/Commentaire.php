<?php

namespace App\Entity;

use App\Repository\CommentaireRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentaireRepository::class)
 */
class Commentaire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nomcommentateur;

    /**
     * @ORM\Column(type="string", length=75)
     */
    private $emailcommentateur;

    /**
     * @ORM\Column(type="text")
     */
    private $textcommentaire;

    /**
     * @ORM\ManyToOne(targetEntity=Post::class, inversedBy="commentaires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $post;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomcommentateur(): ?string
    {
        return $this->nomcommentateur;
    }

    public function setNomcommentateur(string $nomcommentateur): self
    {
        $this->nomcommentateur = $nomcommentateur;

        return $this;
    }

    public function getEmailcommentateur(): ?string
    {
        return $this->emailcommentateur;
    }

    public function setEmailcommentateur(string $emailcommentateur): self
    {
        $this->emailcommentateur = $emailcommentateur;

        return $this;
    }

    public function getTextcommentaire(): ?string
    {
        return $this->textcommentaire;
    }

    public function setTextcommentaire(string $textcommentaire): self
    {
        $this->textcommentaire = $textcommentaire;

        return $this;
    }

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(?Post $post): self
    {
        $this->post = $post;

        return $this;
    }
}
