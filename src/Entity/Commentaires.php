<?php

namespace App\Entity;

use App\Repository\CommentairesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentairesRepository::class)]
class Commentaires
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: clients::class, inversedBy: 'date')]
    #[ORM\JoinColumn(nullable: false)]
    private $client;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $date;

    #[ORM\ManyToOne(targetEntity: animaux::class, inversedBy: 'commentaires')]
    #[ORM\JoinColumn(nullable: false)]
    private $animal;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getAnimal(): ?animaux
    {
        return $this->animal;
    }

    public function setAnimal(?animaux $animal): self
    {
        $this->animal = $animal;

        return $this;
    }
}
