<?php

namespace App\DataFixtures;

use App\Entity\Professional;
use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class ServiceFixtures extends Fixture implements DependentFixtureInterface
{
    CONST SERVICE_NUMBER = 50;


    public function load(ObjectManager $manager)
    {
        for($i=1; $i <= self::SERVICE_NUMBER; $i++) {
            $faker = Faker\Factory::create('en_US');
            $service = new Service();
            $service->setTitle($faker->realText(25));
            $service->setSpecialization($faker->realText(12));
            $service->setLongitude(random_int(-510, 852)/100);
            $service->setLatitude(random_int(4216, 5130)/100);
            $service->setDescription($faker->realText(250));
            $service->setCity($faker->city);
            $service->setCountry($faker->country);
            $service->setAddress(random_int(1,100) . " rue de Paris, " . random_int(1000, 100000) . "Bordeaux");
            $service->setAddressDetails($faker->realText(100));
            $service->setPriceType("free");
            $service->setProfessional($this->getReference('professional_' . rand(1, ProfessionalFixtures::PROFESSIONAL_NUMBER + 1)));
            $service->setCategory($this->getReference('category_' . rand(1, ServiceCategoryFixtures::SERVICE_CATEGORY_NUMBER)));
            $manager->persist($service);
            $this->addReference("service_" . $i, $service);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProfessionalFixtures::class,
            ServiceCategoryFixtures::class,
        );
    }
}
