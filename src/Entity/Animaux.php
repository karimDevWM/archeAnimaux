<?php

namespace App\Entity;

use App\Repository\AnimauxRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnimauxRepository::class)]
class Animaux
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255)]
    private $prenom;

    #[ORM\Column(type: 'string', length: 255)]
    private $email;

    #[ORM\Column(type: 'date')]
    private $Ddn;

    #[ORM\Column(type: 'string', length: 255)]
    private $genre;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\Column(type: 'date', nullable: true)]
    private $dateAdopt;

    #[ORM\OneToMany(mappedBy: 'animal', targetEntity: Commentaires::class, orphanRemoval: true)]
    private $commentaires;

    #[ORM\ManyToOne(targetEntity: clients::class, inversedBy: 'animauxes')]
    #[ORM\JoinColumn(nullable: false)]
    private $client;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getDdn(): ?\DateTimeInterface
    {
        return $this->Ddn;
    }

    public function setDdn(\DateTimeInterface $Ddn): self
    {
        $this->Ddn = $Ddn;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDateAdopt(): ?\DateTimeInterface
    {
        return $this->dateAdopt;
    }

    public function setDateAdopt(?\DateTimeInterface $dateAdopt): self
    {
        $this->dateAdopt = $dateAdopt;

        return $this;
    }

    /**
     * @return Collection<int, Commentaires>
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaires $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setAnimal($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaires $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getAnimal() === $this) {
                $commentaire->setAnimal(null);
            }
        }

        return $this;
    }

    public function getClient(): ?clients
    {
        return $this->client;
    }

    public function setClient(?clients $client): self
    {
        $this->client = $client;

        return $this;
    }
}
