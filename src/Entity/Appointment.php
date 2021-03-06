<?php

namespace App\Entity;

use App\Repository\AppointmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AppointmentRepository::class)
 */
class Appointment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Beneficiary::class, inversedBy="appointments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $beneficiary;

    /**
     * @ORM\Column(type="boolean")
     */
    private $canceled = false;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startingTime;

    /**
     * @ORM\Column(type="datetime")
     */
    private $endingTime;

    /**
     * @ORM\ManyToOne(targetEntity=Service::class, inversedBy="appointments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $service;

    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBeneficiary(): Beneficiary
    {
        return $this->beneficiary;
    }

    public function setBeneficiary(Beneficiary $beneficiary): self
    {
        $this->beneficiary = $beneficiary;

        return $this;
    }

    public function getCanceled(): ?bool
    {
        return $this->canceled;
    }

    public function setCanceled(bool $canceled): self
    {
        $this->canceled = $canceled;

        return $this;
    }

    public function getStartingTime(): ?\DateTimeInterface
    {
        return $this->startingTime;
    }

    public function setStartingTime(\DateTimeInterface $startingTime): self
    {
        $this->startingTime = $startingTime;

        return $this;
    }

    public function getEndingTime(): ?\DateTimeInterface
    {
        return $this->endingTime;
    }

    public function setEndingTime(\DateTimeInterface $endingTime): self
    {
        $this->endingTime = $endingTime;

        return $this;
    }

    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): self
    {
        $this->service = $service;

        return $this;
    }
}
