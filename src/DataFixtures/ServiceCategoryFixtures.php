<?php

namespace App\DataFixtures;

use App\Entity\ServiceCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;


class ServiceCategoryFixtures extends Fixture
{
    CONST SERVICE_CATEGORY_NUMBER = 50;

    public function randomColor() {
        $hexa = ["0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f"];
        $color = "#";
        for ($i=0; $i < 6; $i++) {
            $randHexa = $hexa[array_rand($hexa)];
            $color.= $randHexa;
        }

        return $color;
    }

    public function randomIcon() {
        $icons = ["psychologist.png", "doctor.png"];

        return $icons[array_rand($icons)];
    }

    public function load(ObjectManager $manager)
    {
        $faker  =  Faker\Factory::create('en_US');
        for($i=1; $i <= self::SERVICE_CATEGORY_NUMBER; $i++) {
            $category = new ServiceCategory();
            $category->setColor($this->randomColor());
            $category->setName($faker->name);
            $category->setIcon($this->randomIcon());
            $manager->persist($category);
            $this->addReference('category_' . $i, $category);
        }
        $manager->flush();
    }
}
