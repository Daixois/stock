<?php

namespace App\Entity;

use App\Repository\MovieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MovieRepository::class)]
class Movie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $format;

    #[ORM\ManyToMany(targetEntity: Format::class, mappedBy: 'movie')]
    private $formats;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $sort;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $poster_path;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $tmdbId;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    private $imdbId;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $originalTitle;

    #[ORM\Column(type: 'text', nullable: true)]
    private $overview;

    #[ORM\Column(type: 'date', nullable: true)]
    private $release_date;

    public function __construct()
    {
        $this->formats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function setFormat(?string $format): self
    {
        $this->format = $format;

        return $this;
    }

    /**
     * @return Collection|Format[]
     */
    public function getFormats(): Collection
    {
        return $this->formats;
    }

    public function addFormat(Format $format): self
    {
        if (!$this->formats->contains($format)) {
            $this->formats[] = $format;
            $format->addMovie($this);
        }

        return $this;
    }

    public function removeFormat(Format $format): self
    {
        if ($this->formats->removeElement($format)) {
            $format->removeMovie($this);
        }

        return $this;
    }

    public function getSort(): ?string
    {
        return $this->sort;
    }

    public function setSort(?string $sort): self
    {
        $this->sort = $sort;

        return $this;
    }

    public function getPosterPath(): ?string
    {
        return $this->poster_path;
    }

    public function setPosterPath(?string $poster_path): self
    {
        $this->poster_path = $poster_path;

        return $this;
    }

    public function getTmdbId(): ?int
    {
        return $this->tmdbId;
    }

    public function setTmdbId(?int $tmdbId): self
    {
        $this->tmdbId = $tmdbId;

        return $this;
    }

    public function getImdbId(): ?string
    {
        return $this->imdbId;
    }

    public function setImdbId(?string $imdbId): self
    {
        $this->imdbId = $imdbId;

        return $this;
    }

    public function getOriginalTitle(): ?string
    {
        return $this->originalTitle;
    }

    public function setOriginalTitle(?string $originalTitle): self
    {
        $this->originalTitle = $originalTitle;

        return $this;
    }

    public function getOverview(): ?string
    {
        return $this->overview;
    }

    public function setOverview(?string $overview): self
    {
        $this->overview = $overview;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->release_date;
    }

    public function setReleaseDate(?\DateTimeInterface $release_date): self
    {
        $this->release_date = $release_date;

        return $this;
    }
}
