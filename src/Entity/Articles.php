<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticlesRepository")
 */
class Articles
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $accroche;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="text")
     */
    private $texte;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $resume;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Menus", inversedBy="articles")
     */
    private $menus;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SousMenus", inversedBy="articles")
     */
    private $sousMenu;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Photos", cascade={"persist", "remove"})
     */
    private $photos;

    /**
     * @return mixed
     */
    public function getPhotos()
    {
        return $this->photos;
    }

    /**
     * @param mixed $photos
     */
    public function setPhotos($photos): void
    {
        $this->photos = $photos;
    }




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAccroche(): ?string
    {
        return $this->accroche;
    }

    public function setAccroche(?string $accroche): self
    {
        $this->accroche = $accroche;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getTexte(): ?string
    {
        return $this->texte;
    }

    public function setTexte(string $texte): self
    {
        $this->texte = $texte;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(?string $resume): self
    {
        $this->resume = $resume;

        return $this;
    }

    public function getMenus(): ?Menus
    {
        return $this->menus;
    }

    public function setMenus(?Menus $menus): self
    {
        $this->menus = $menus;

        return $this;
    }

    public function getSousMenu(): ?SousMenus
    {
        return $this->sousMenu;
    }

    public function setSousMenu(?SousMenus $sousMenu): self
    {
        $this->sousMenu = $sousMenu;

        return $this;
    }



}
