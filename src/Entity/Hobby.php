<?php

namespace App\Entity;

use App\Repository\HobbyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HobbyRepository::class)]
class Hobby
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\ManyToMany(targetEntity: Human::class, mappedBy: 'hobbies')]
    private Collection $humans;

    public function __construct()
    {
        $this->humans = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection<int, Human>
     */
    public function getHumans(): Collection
    {
        return $this->humans;
    }

    public function addHuman(Human $human): static
    {
        if (!$this->humans->contains($human)) {
            $this->humans->add($human);
            $human->addHobby($this);
        }

        return $this;
    }

    public function removeHuman(Human $human): static
    {
        if ($this->humans->removeElement($human)) {
            $human->removeHobby($this);
        }

        return $this;
    }
}
