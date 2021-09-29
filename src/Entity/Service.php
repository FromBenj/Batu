<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=ServiceRepository::class)
 */
class Service
{
    CONST CATEGORIES = [
        "Psychologist",
        "Family Doctor",
        "Accommodation",
        "Food and Drinks",
        "Hairdresser",
    ];

    CONST LANGUAGES = [
        "English",
        "Arabic",
        "French",
    ];


    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $category;

    /**
     * @ORM\Column(type="array")
     */
    private $languages = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $specialization;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $addressDetails;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $housenumber;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $street;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $county;

    /**
     * @ORM\Column(type="float")
     */
    private $latitude;

    /**
     * @ORM\Column(type="float")
     */
    private $longitude;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $postcode;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        if (in_array($category,self::CATEGORIES)) {
        $this->category = $category;
        }

        return $this;
    }

    public function getLanguages(): ?array
    {
        return $this->languages;
    }

    public function setLanguages(array $languages): self
    {
        $chosenLanguages = [];
        foreach ($languages as $language) {
            if (in_array($language, self::LANGUAGES, true)) {
                $chosenLanguages[] = $language;
            }
            $this->languages = $chosenLanguages;
        }

        return $this;
    }

    public function getSpecialization(): ?string
    {
        return $this->specialization;
    }

    public function setSpecialization(?string $specialization): self
    {
        $this->specialization = $specialization;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getAddressDetails(): ?string
    {
        return $this->addressDetails;
    }

    public function setAddressDetails(string $addressDetails): self
    {
        $this->addressDetails = $addressDetails;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCoordinates(): ?array
    {
        if($this->latitude && $this->longitude) {
            return [$this->latitude, $this->longitude];
        }

        return null;
    }

    public function setCoordinates(float $latitude, float $longitude): self
    {
        $this->setLatitude($latitude);
        $this->setLongitude($longitude);

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getHousenumber(): ?string
    {
        return $this->housenumber;
    }

    public function setHousenumber(?string $housenumber): self
    {
        $this->housenumber = $housenumber;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getCounty(): ?string
    {
        return $this->county;
    }

    public function setCounty(?string $county): self
    {
        $this->county = $county;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getPostcode(): ?int
    {
        return $this->postcode;
    }

    public function setPostcode(?int $postcode): self
    {
        $this->postcode = $postcode;

        return $this;
    }
}
