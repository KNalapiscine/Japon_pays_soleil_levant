<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PhotosRepository")
 */
class Photos
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
    private $Nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Description;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Articles", cascade={"persist", "remove"})
     */
    private $Articles;












    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getArticles(): ?self
    {
        return $this->Articles;
    }

    public function setArticles(?articles $Articles): self
    {
        $this->Articles = $Articles;

        return $this;
    }
}
