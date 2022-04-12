<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 */
class Categorie
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
    private $nomcategorie;

    /**
     * @ORM\ManyToMany(targetEntity=Post::class, mappedBy="categories")
     */
    private $posts;

    /**
     * @ORM\OneToMany(targetEntity=Typeproduit::class, mappedBy="categorie")
     */
    private $types;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
        $this->typeproduits = new ArrayCollection();
        $this->types = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomcategorie(): ?string
    {
        return $this->nomcategorie;
    }

    public function setNomcategorie(string $nomcategorie): self
    {
        $this->nomcategorie = $nomcategorie;

        return $this;
    }

    /**
     * @return Collection|Post[]
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts[] = $post;
            $post->addCategory($this);
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        if ($this->posts->removeElement($post)) {
            $post->removeCategory($this);
        }

        return $this;
    }

    /**
     * @return Collection|Typeproduit[]
     */
    public function getTypes(): Collection
    {
        return $this->types;
    }

    public function addType(Typeproduit $type): self
    {
        if (!$this->types->contains($type)) {
            $this->types[] = $type;
            $type->setCategorie($this);
        }

        return $this;
    }

    public function removeType(Typeproduit $type): self
    {
        if ($this->types->removeElement($type)) {
            // set the owning side to null (unless already changed)
            if ($type->getCategorie() === $this) {
                $type->setCategorie(null);
            }
        }

        return $this;
    }
}
