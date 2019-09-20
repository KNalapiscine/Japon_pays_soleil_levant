<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MenusRepository")
 */
class Menus
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Libelle;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Articles", mappedBy="menus")
     */
    private $article;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SousMenus", mappedBy="menu")
     */
    private $sousMenuses;


    public function __construct()
    {
        $this->article = new ArrayCollection();
        $this->sousMenuses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->Libelle;
    }

    public function setLibelle(string $Libelle): self
    {
        $this->Libelle = $Libelle;

        return $this;
    }

    /**
     * @return Collection|Articles[]
     */
    public function getArticle(): Collection
    {
        return $this->article;
    }

    public function addArticle(Articles $article): self
    {
        if (!$this->article->contains($article)) {
            $this->article[] = $article;
            $article->setMenus($this);
        }

        return $this;
    }

    public function removeArticle(Articles $article): self
    {
        if ($this->article->contains($article)) {
            $this->article->removeElement($article);
            // set the owning side to null (unless already changed)
            if ($article->getMenus() === $this) {
                $article->setMenus(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|SousMenus[]
     */
    public function getSousMenuses(): Collection
    {
        return $this->sousMenuses;
    }

    public function addSousMenus(SousMenus $sousMenus): self
    {
        if (!$this->sousMenuses->contains($sousMenus)) {
            $this->sousMenuses[] = $sousMenus;
            $sousMenus->setMenu($this);
        }

        return $this;
    }

    public function removeSousMenus(SousMenus $sousMenus): self
    {
        if ($this->sousMenuses->contains($sousMenus)) {
            $this->sousMenuses->removeElement($sousMenus);
            // set the owning side to null (unless already changed)
            if ($sousMenus->getMenu() === $this) {
                $sousMenus->setMenu(null);
            }
        }

        return $this;
    }


}
