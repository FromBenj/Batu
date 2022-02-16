<?php

namespace App\Entity;

use App\Repository\PlanningRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlanningRepository::class)
 */
class Planning
{
    public const WEEK_DAYS = ["Monday", "Tuesday", "Wednesday","Thursday", "Friday", "Saturday", "Sunday"];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Professional::class, inversedBy="planning", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $professional;

    /**
     * @ORM\OneToMany(targetEntity=Slot::class, mappedBy="planning")
     */
    private $slots;

    public function __construct()
    {
        $this->slots = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProfessional(): ?Professional
    {
        return $this->professional;
    }

    public function setProfessional(Professional $professional): self
    {
        $this->professional = $professional;

        return $this;
    }

    /**
     * @return Collection|Slot[]
     */
    public function getSlots(): Collection
    {
        return $this->slots;
    }

    public function addSlot(Slot $slot): self
    {
        if (!$this->slots->contains($slot)) {
            $this->slots[] = $slot;
            $slot->setPlanning($this);
        }

        return $this;
    }

    public function removeSlot(Slot $slot): self
    {
        if ($this->slots->removeElement($slot)) {
            // set the owning side to null (unless already changed)
            if ($slot->getPlanning() === $this) {
                $slot->setPlanning(null);
            }
        }

        return $this;
    }
}
