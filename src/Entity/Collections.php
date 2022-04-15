<?php

namespace App\Entity;

use App\Repository\CollectionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Expr\Value;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[Vich\Uploadable]
#[ORM\Entity(repositoryClass:CollectionsRepository::class)]
class Collections
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $Type;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $Picture;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $createdAt;

    #[ORM\Column(type: 'date', nullable: true)]
    private $UpdatedAt;
    
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $image;


    #[Vich\UploadableField(mapping:'collection_image', fileNameProperty:"image")]
    private $imageFile;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'collections')]
    private $User_id;

    public function __construct()
    {
        $this->type = new ArrayCollection();
        $this->createdAt = new \DateTime("now");
        $this->UpdatedAt = new \DateTime("now");
        $this->User_id = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(?string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->Picture;
    }

    public function setPicture(?string $Picture): self
    {
        $this->picture = $Picture;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->UpdatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $UpdatedAt): self
    {
        $this->UpdatedAt = $UpdatedAt;

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

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile = null)
    {
        $this->imageFile = $imageFile;

        if ($imageFile) {
           
            $this->updatedAt = new \DateTime('now');
        }
        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUserId(): Collection
    {
        return $this->User_id;
    }

    public function addUserId(User $userId): self
    {
        if (!$this->User_id->contains($userId)) {
            $this->User_id[] = $userId;
        }

        return $this;
    }

    public function removeUserId(User $userId): self
    {
        $this->User_id->removeElement($userId);

        return $this;
    }

}