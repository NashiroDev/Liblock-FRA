<?php

namespace App\Entity;

use App\Repository\ImageFileRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageFileRepository::class)]
class ImageFile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Articles::class, inversedBy: 'imageFiles')]
    private Collection $articles_id;

    #[ORM\Column(length: 255)]
    private ?string $image_name = null;

    #[ORM\Column]
    private ?int $file_size = null;

    public function __construct()
    {
        $this->articles_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Articles>
     */
    public function getArticlesId(): Collection
    {
        return $this->articles_id;
    }

    public function addArticlesId(Articles $articlesId): self
    {
        if (!$this->articles_id->contains($articlesId)) {
            $this->articles_id->add($articlesId);
        }

        return $this;
    }

    public function removeArticlesId(Articles $articlesId): self
    {
        $this->articles_id->removeElement($articlesId);

        return $this;
    }

    public function getImageName(): ?string
    {
        return $this->image_name;
    }

    public function setImageName(string $image_name): self
    {
        $this->image_name = $image_name;

        return $this;
    }

    public function getFileSize(): ?int
    {
        return $this->file_size;
    }

    public function setFileSize(int $file_size): self
    {
        $this->file_size = $file_size;

        return $this;
    }
}
