<?php

namespace App\Entity;

use App\Repository\ArticlesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticlesRepository::class)]
class Articles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column(type: Types::JSON, nullable: true)]
    private array $images = [];

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $footer = null;

    #[ORM\ManyToOne(inversedBy: 'userArticles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $author = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $owner = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $proposedAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $acceptedAt = null;

    #[ORM\Column(length: 20)]
    private ?string $status = null;

    #[ORM\ManyToMany(targetEntity: Themes::class, inversedBy: 'articles')]
    private Collection $themes;

    #[ORM\ManyToMany(targetEntity: ImageFile::class, mappedBy: 'articles_id')]
    private Collection $imageFiles;

    public function __construct()
    {
        $this->themes = new ArrayCollection();
        $this->imageFiles = new ArrayCollection();
    }
    
    public function getId()
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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getImages(): array
    {
        return $this->images;
    }

    public function setImages(?array $images): self
    {
        $this->images = $images;

        return $this;
    }

    public function getFooter(): ?string
    {
        return $this->footer;
    }

    public function setFooter(?string $footer): self
    {
        $this->footer = $footer;

        return $this;
    }
    
    public function getAuthor(): ?users
    {
        return $this->author;
    }

    public function setAuthor(?users $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getOwner(): ?users
    {
        return $this->owner;
    }

    public function setOwner(?users $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getProposedAt(): ?\DateTimeImmutable
    {
        return $this->proposedAt;
    }

    public function setProposedAt(\DateTimeImmutable $proposedAt): self
    {
        $this->proposedAt = $proposedAt;

        return $this;
    }

    public function getAcceptedAt(): ?\DateTimeImmutable
    {
        return $this->acceptedAt;
    }

    public function setAcceptedAt(?\DateTimeImmutable $acceptedAt): self
    {
        $this->acceptedAt = $acceptedAt;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, Themes>
     */
    public function getThemes(): Collection
    {
        return $this->themes;
    }

    public function addTheme(Themes $theme): self
    {
        if (!$this->themes->contains($theme)) {
            $this->themes->add($theme);
        }

        return $this;
    }

    public function removeTheme(Themes $theme): self
    {
        $this->themes->removeElement($theme);

        return $this;
    }

    /**
     * @return Collection<int, ImageFile>
     */
    public function getImageFiles(): Collection
    {
        return $this->imageFiles;
    }

    public function addImageFile(ImageFile $imageFile): self
    {
        if (!$this->imageFiles->contains($imageFile)) {
            $this->imageFiles->add($imageFile);
            $imageFile->addArticlesId($this);
        }

        return $this;
    }

    public function removeImageFile(ImageFile $imageFile): self
    {
        if ($this->imageFiles->removeElement($imageFile)) {
            $imageFile->removeArticlesId($this);
        }

        return $this;
    }
}
