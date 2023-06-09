<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
class Users
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 129)]
    private ?string $wallet = null;

    #[ORM\OneToMany(mappedBy: 'author', targetEntity: Articles::class)]
    private Collection $userArticles;

    public function __construct()
    {
        $this->userArticles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getWallet(): ?string
    {
        return $this->wallet;
    }

    public function setWallet(string $wallet): self
    {
        $this->wallet = $wallet;

        return $this;
    }

    /**
     * @return Collection<int, Articles>
     */
    public function getUserArticles(): Collection
    {
        return $this->userArticles;
    }

    public function addUserArticle(Articles $userArticle): self
    {
        if (!$this->userArticles->contains($userArticle)) {
            $this->userArticles->add($userArticle);
            $userArticle->setAuthor($this);
        }

        return $this;
    }

    public function removeUserArticle(Articles $userArticle): self
    {
        if ($this->userArticles->removeElement($userArticle)) {
            // set the owning side to null (unless already changed)
            if ($userArticle->getAuthor() === $this) {
                $userArticle->setAuthor(null);
            }
        }

        return $this;
    }
}
