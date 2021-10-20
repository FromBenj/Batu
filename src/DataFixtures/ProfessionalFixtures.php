<?php


namespace App\DataFixtures;

use App\Entity\Professional;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;


class ProfessionalFixtures extends Fixture
{
    CONST PROFESSIONAL_NUMBER = 50;

    public function load(ObjectManager $manager)
    {
        $faker  =  Faker\Factory::create('en_US');
        for($i=1; $i <= self::PROFESSIONAL_NUMBER; $i++) {
            $professional = new Professional();
            $professional->setLanguages(["English"]);
            $professional->setRoles(["ROLE_USER"]);
            $professional->setEmail($faker->email);
            $professional->setPassword($faker->password);
            $manager->persist($professional);
            $this->addReference('professional_' . $i, $professional);
        }
        $professional = new Professional();
        $professional->setLanguages(["English"]);
        $professional->setRoles(["ROLE_ADMIN"]);
        $professional->setEmail("test@test.fr");
        $professional->setPassword("TESTtest");
        $manager->persist($professional);
        $this->addReference('professional_' . (self::PROFESSIONAL_NUMBER + 1), $professional);

        $manager->flush();
    }

}
