<?php

namespace App\Entity;

use App\Repository\ClientsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientsRepository::class)]
class Clients
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255)]
    private $prenom;

    #[ORM\Column(type: 'date', nullable: true)]
    private $ddn;

    #[ORM\Column(type: 'string', length: 255)]
    private $mail;

    #[ORM\Column(type: 'string', length: 255)]
    private $mdp;

    #[ORM\Column(type: 'string', length: 255)]
    private $adresse;

    #[ORM\Column(type: 'string', length: 255)]
    private $cp;

    #[ORM\Column(type: 'string', length: 255)]
    private $ville;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $image;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: Commentaires::class, orphanRemoval: true)]
    private $date;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: Animaux::class, orphanRemoval: true)]
    private $animauxes;

    public function __construct()
    {
        $this->date = new ArrayCollection();
        $this->animauxes = new ArrayCollection();
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

    public function getDdn(): ?\DateTimeInterface
    {
        return $this->ddn;
    }

    public function setDdn(?\DateTimeInterface $ddn): self
    {
        $this->ddn = $ddn;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): self
    {
        $this->mdp = $mdp;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCp(): ?string
    {
        return $this->cp;
    }

    public function setCp(string $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, Commentaires>
     */
    public function getDate(): Collection
    {
        return $this->date;
    }

    public function addDate(Commentaires $date): self
    {
        if (!$this->date->contains($date)) {
            $this->date[] = $date;
            $date->setClient($this);
        }

        return $this;
    }

    public function removeDate(Commentaires $date): self
    {
        if ($this->date->removeElement($date)) {
            // set the owning side to null (unless already changed)
            if ($date->getClient() === $this) {
                $date->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Animaux>
     */
    public function getAnimauxes(): Collection
    {
        return $this->animauxes;
    }

    public function addAnimaux(Animaux $animaux): self
    {
        if (!$this->animauxes->contains($animaux)) {
            $this->animauxes[] = $animaux;
            $animaux->setClient($this);
        }

        return $this;
    }

    public function removeAnimaux(Animaux $animaux): self
    {
        if ($this->animauxes->removeElement($animaux)) {
            // set the owning side to null (unless already changed)
            if ($animaux->getClient() === $this) {
                $animaux->setClient(null);
            }
        }

        return $this;
    }
}
