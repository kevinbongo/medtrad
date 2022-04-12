<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 */
class Post
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titrepost;

    /**
     * @ORM\Column(type="date")
     */
    private $datepublication;

    /**
     * @ORM\Column(type="text")
     */
    private $contenupost;

    /**
     * @ORM\ManyToMany(targetEntity=Categorie::class, inversedBy="posts")
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="post", orphanRemoval=true)
     */
    private $commentaires;

    /**
     * @ORM\ManyToMany(targetEntity=Produit::class, inversedBy="postslies")
     */
    private $produitslies;

    /**
     * @ORM\ManyToMany(targetEntity=Post::class)
     */
    private $postslies;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="posts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $utilisateur;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
        $this->produitslies = new ArrayCollection();
        $this->postslies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitrepost(): ?string
    {
        return $this->titrepost;
    }

    public function setTitrepost(string $titrepost): self
    {
        $this->titrepost = $titrepost;

        return $this;
    }

    public function getDatepublication(): ?\DateTimeInterface
    {
        return $this->datepublication;
    }

    public function setDatepublication(\DateTimeInterface $datepublication): self
    {
        $this->datepublication = $datepublication;

        return $this;
    }

    public function getContenupost(): ?string
    {
        return $this->contenupost;
    }

    public function setContenupost(string $contenupost): self
    {
        $this->contenupost = $contenupost;

        return $this;
    }

    /**
     * @return Collection|categorie[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categorie $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
        }

        return $this;
    }

    public function removeCategory(Categorie $category): self
    {
        $this->categories->removeElement($category);

        return $this;
    }

    /**
     * @return Collection|Commentaire[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setPost($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getPost() === $this) {
                $commentaire->setPost(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|produit[]
     */
    public function getProduitslies(): Collection
    {
        return $this->produitslies;
    }

    public function addProduitsly(produit $produitsly): self
    {
        if (!$this->produitslies->contains($produitsly)) {
            $this->produitslies[] = $produitsly;
        }

        return $this;
    }

    public function removeProduitsly(produit $produitsly): self
    {
        $this->produitslies->removeElement($produitsly);

        return $this;
    }

    /**
     * @return Collection|post[]
     */
    public function getPostslies(): Collection
    {
        return $this->postslies;
    }

    public function addPostsly(post $postsly): self
    {
        if (!$this->postslies->contains($postsly)) {
            $this->postslies[] = $postsly;
        }

        return $this;
    }

    public function removePostsly(post $postsly): self
    {
        $this->postslies->removeElement($postsly);

        return $this;
    }

    public function getUtilisateur(): ?User
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?User $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }
}
