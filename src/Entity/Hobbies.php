<?php

namespace App\Entity;

use App\Repository\HobbiesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HobbiesRepository::class)]
class Hobbies
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 700)]
    private ?string $designation = null;

    #[ORM\ManyToMany(targetEntity: Person::class, mappedBy: 'hobbies')]
    private Collection $peoples;

    public function __construct()
    {
        $this->peoples = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * @return Collection<int, Person>
     */
    public function getPeoples(): Collection
    {
        return $this->peoples;
    }

    public function addPeople(Person $people): self
    {
        if (!$this->peoples->contains($people)) {
            $this->peoples->add($people);
            $people->addHobby($this);
        }

        return $this;
    }

    public function removePeople(Person $people): self
    {
        if ($this->peoples->removeElement($people)) {
            $people->removeHobby($this);
        }

        return $this;
    }
}
