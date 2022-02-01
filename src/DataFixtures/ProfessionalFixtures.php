<?php


namespace App\DataFixtures;

use App\DataFixtures\LanguageFixtures;
use App\Entity\Professional;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;


class ProfessionalFixtures extends Fixture implements DependentFixtureInterface
{
    CONST PROFESSIONAL_NUMBER = 50;


    public function randomLanguages() {
        $totalLanguages = languageFixtures::LANGUAGES;
        $languages = [];
        $random = rand(1, count($totalLanguages));
        for ($i = 1; $i <= $random; $i++) {
            $languages[] = array_shift($totalLanguages);
        }

        return $languages;
    }

    public function load(ObjectManager $manager)
    {
        //Empty professional extra data for the moment

        /*
        $faker  =  Faker\Factory::create('en_US');
        for($i=1; $i <= self::PROFESSIONAL_NUMBER; $i++) {
            $randLanguages = rand(1, count(languageFixtures::LANGUAGES));
            $professional = new Professional();
            $professional->setFirstName($faker->firstName);
            $professional->setLastName($faker->lastName);
            $professional->setEmail($faker->email);
            for ($j = 1; $j <= $randLanguages; $j++) {
                $professional->addLanguage($this->getReference('language_' . $j));
            }
            $manager->persist($professional);
            $this->addReference('professional_' . $i, $professional);
        }

        $professional = new Professional();
        $professional->setLastName($faker->lastName);
        $professional->setFirstName("FromBenj");
        $professional->setEmail("test@test.fr");
        for ($j = 1; $j <= count(languageFixtures::LANGUAGES); $j++) {
            $professional->addLanguage($this->getReference('language_' . $j));
        }
        $manager->persist($professional);
        $this->addReference('professional_' . (self::PROFESSIONAL_NUMBER + 1), $professional);

        $manager->flush();

        */
    }

    public function getDependencies()
    {
        return array(
            LanguageFixtures::class,
        );
    }

}
