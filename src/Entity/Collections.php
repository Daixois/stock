<?php

namespace App\Entity;

use App\Repository\CollectionsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CollectionsRepository::class)]
class Collections
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $Films;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $Livres;

    #[ORM\Column(type: 'string', length: 255)]
    private $Musique;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $Jeuxvideos;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $Presse;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFilms(): ?string
    {
        return $this->Films;
    }

    public function setFilms(?string $Films): self
    {
        $this->Films = $Films;

        return $this;
    }

    public function getLivres(): ?string
    {
        return $this->Livres;
    }

    public function setLivres(?string $Livres): self
    {
        $this->Livres = $Livres;

        return $this;
    }

    public function getMusique(): ?string
    {
        return $this->Musique;
    }

    public function setMusique(string $Musique): self
    {
        $this->Musique = $Musique;

        return $this;
    }

    public function getJeuxvideos(): ?string
    {
        return $this->Jeuxvideos;
    }

    public function setJeuxvideos(?string $Jeuxvideos): self
    {
        $this->Jeuxvideos = $Jeuxvideos;

        return $this;
    }

    public function getPresse(): ?string
    {
        return $this->Presse;
    }

    public function setPresse(?string $Presse): self
    {
        $this->Presse = $Presse;

        return $this;
    }
}
