<?php

namespace App\Entity;

use App\Repository\PlanningRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlanningRepository::class)
 */
class Planning
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="array")
     */
    private $slots = [];

    /**
     * @ORM\OneToOne(targetEntity=Professional::class, inversedBy="planning", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $professional;

    public function __construct()
    {
        $this->slots = [
            "monday"    => [],
            "tuesday"   => [],
            "wednesday" => [],
            "thursday"  => [],
            "friday"    => [],
            "saturday"  => [],
            "sunday"    => [],
        ];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlots(): ?array
    {
        return $this->slots;
    }

    public function setSlots(array $slots): self
    {
        $this->slots = $slots;

        return $this;
    }

    public function addSlot(string $day, dateTime $startTime, dateTime $endTime): ?self
    {
        if ($startTime && $endTime && array_key_exists($day, $this->slots)) {
            $slots = $this->slots;
            $slots[$day][] = [$startTime, $endTime];

            return $this;
        }

        return null;
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
}
