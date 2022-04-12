<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 */
class Produit
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
    private $nomproduit;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $prixunitaire;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantitedispo;

    /**
     * @ORM\Column(type="boolean")
     */
    private $statutproduit;

    /**
     * @ORM\Column(type="date")
     */
    private $datemiseenligne;

    /**
     * @ORM\Column(type="integer")
     */
    private $noteproduit;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombredereviews;

    /**
     * @ORM\ManyToOne(targetEntity=Marque::class, inversedBy="produits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $marque;

    /**
     * @ORM\ManyToMany(targetEntity=Commande::class, mappedBy="produits")
     */
    private $commandes;

    /**
     * @ORM\ManyToMany(targetEntity=Post::class, mappedBy="produitslies")
     */
    private $postslies;

    /**
     * @ORM\ManyToOne(targetEntity=Typeproduit::class, inversedBy="produits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;


    public function __construct()
    {
        $this->commandes = new ArrayCollection();
        $this->postslies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomproduit(): ?string
    {
        return $this->nomproduit;
    }

    public function setNomproduit(string $nomproduit): self
    {
        $this->nomproduit = $nomproduit;

        return $this;
    }

    public function getPrixunitaire(): ?int
    {
        return $this->prixunitaire;
    }

    public function setPrixunitaire(?int $prixunitaire): self
    {
        $this->prixunitaire = $prixunitaire;

        return $this;
    }

    public function getQuantitedispo(): ?int
    {
        return $this->quantitedispo;
    }

    public function setQuantitedispo(int $quantitedispo): self
    {
        $this->quantitedispo = $quantitedispo;

        return $this;
    }

    public function getStatutproduit(): ?bool
    {
        return $this->statutproduit;
    }

    public function setStatutproduit(bool $statutproduit): self
    {
        $this->statutproduit = $statutproduit;

        return $this;
    }

    public function getDatemiseenligne(): ?\DateTimeInterface
    {
        return $this->datemiseenligne;
    }

    public function setDatemiseenligne(\DateTimeInterface $datemiseenligne): self
    {
        $this->datemiseenligne = $datemiseenligne;

        return $this;
    }

    public function getNoteproduit(): ?int
    {
        return $this->noteproduit;
    }

    public function setNoteproduit(int $noteproduit): self
    {
        $this->noteproduit = $noteproduit;

        return $this;
    }

    public function getNombredereviews(): ?int
    {
        return $this->nombredereviews;
    }

    public function setNombredereviews(int $nombredereviews): self
    {
        $this->nombredereviews = $nombredereviews;

        return $this;
    }

    public function getMarque(): ?Marque
    {
        return $this->marque;
    }

    public function setMarque(?Marque $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->addProduit($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            $commande->removeProduit($this);
        }

        return $this;
    }

    /**
     * @return Collection|Post[]
     */
    public function getPostslies(): Collection
    {
        return $this->postslies;
    }

    public function addPostsly(Post $postsly): self
    {
        if (!$this->postslies->contains($postsly)) {
            $this->postslies[] = $postsly;
            $postsly->addProduitsly($this);
        }

        return $this;
    }

    public function removePostsly(Post $postsly): self
    {
        if ($this->postslies->removeElement($postsly)) {
            $postsly->removeProduitsly($this);
        }

        return $this;
    }

    public function getType(): ?Typeproduit
    {
        return $this->type;
    }

    public function setType(?Typeproduit $type): self
    {
        $this->type = $type;

        return $this;
    }
}
