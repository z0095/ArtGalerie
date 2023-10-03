<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $picture_src = null;

    #[ORM\Column(length: 255)]
    private ?string $picture_name = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Column]
    private ?bool $disponsibility = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\OneToOne(mappedBy: 'product', cascade: ['persist', 'remove'])]
    private ?Commande $commande = null;

    #[ORM\ManyToMany(targetEntity: category::class, inversedBy: 'products')]
    private Collection $category;

    public function __construct()
    {
        $this->category = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getPictureSrc(): ?string
    {
        return $this->picture_src;
    }

    public function setPictureSrc(string $picture_src): static
    {
        $this->picture_src = $picture_src;

        return $this;
    }

    public function getPictureName(): ?string
    {
        return $this->picture_name;
    }

    public function setPictureName(string $picture_name): static
    {
        $this->picture_name = $picture_name;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function isDisponsibility(): ?bool
    {
        return $this->disponsibility;
    }

    public function setDisponsibility(bool $disponsibility): static
    {
        $this->disponsibility = $disponsibility;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(Commande $commande): static
    {
        // set the owning side of the relation if necessary
        if ($commande->getProduct() !== $this) {
            $commande->setProduct($this);
        }

        $this->commande = $commande;

        return $this;
    }

    /**
     * @return Collection<int, category>
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(category $category): static
    {
        if (!$this->category->contains($category)) {
            $this->category->add($category);
        }

        return $this;
    }

    public function removeCategory(category $category): static
    {
        $this->category->removeElement($category);

        return $this;
    }
}
