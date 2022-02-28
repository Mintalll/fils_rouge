<?php

namespace App\Entity;

use App\Repository\CategRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategRepository::class)
 */
class Categ
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $categorie;

    /**
     * @ORM\OneToMany(targetEntity=Nom::class, mappedBy="categ")
     */
    private $noms;

    public function __construct()
    {
        $this->noms = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(?string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection<int, Nom>
     */
    public function getNoms(): Collection
    {
        return $this->noms;
    }

    public function addNom(Nom $nom): self
    {
        if (!$this->noms->contains($nom)) {
            $this->noms[] = $nom;
            $nom->setCateg($this);
        }

        return $this;
    }

    public function removeNom(Nom $nom): self
    {
        if ($this->noms->removeElement($nom)) {
            // set the owning side to null (unless already changed)
            if ($nom->getCateg() === $this) {
                $nom->setCateg(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->categorie;
    }
}
