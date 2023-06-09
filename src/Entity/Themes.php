<?php

namespace App\Entity;

use App\Repository\ThemesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ThemesRepository::class)]
class Themes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Articles::class, mappedBy: 'tags')]
    private Collection $themeArticles;

    public function __construct()
    {
        $this->themeArticles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Articles>
     */
    public function getThemeArticles(): Collection
    {
        return $this->themeArticles;
    }

    public function addThemeArticle(Articles $themeArticle): self
    {
        if (!$this->themeArticles->contains($themeArticle)) {
            $this->themeArticles->add($themeArticle);
            $themeArticle->addTag($this);
        }

        return $this;
    }

    public function removeThemeArticle(Articles $themeArticle): self
    {
        if ($this->themeArticles->removeElement($themeArticle)) {
            $themeArticle->removeTag($this);
        }

        return $this;
    }
}
