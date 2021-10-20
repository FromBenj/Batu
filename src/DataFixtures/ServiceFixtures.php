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


    public function load(ObjectManager $manager)
    {
        for($i=1; $i<=50; $i++) {
            $faker = Faker\Factory::create('en_US');
            $service = new Service();
            $service->setTitle($faker->title);
            $service->setLongitude($faker->longitude);
            $service->setLatitude($faker->latitude);
            $service->setAddress($faker->address);
            $service->setAddressDetails("hello");
            $service->setDescription("hello");
            $service->setCity($faker->city);
            $service->setCountry($faker->country);
            $service->setPriceType("free");
            $service->setProfessional($this->getReference('professional_' . rand(1, ProfessionalFixtures::PROFESSIONAL_NUMBER)));
            $service->setCategory($this->getReference('category_' . rand(1, ServiceCategoryFixtures::SERVICE_CATEGORY_NUMBER)));
            $manager->persist($service);
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
