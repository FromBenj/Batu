<?php

namespace App\DataFixtures;

use App\Entity\Language;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class LanguageFixtures extends Fixture
{
    CONST LANGUAGES = [
        "french"  => "Français",
        "spanish" => "Español",
        "english" => "Anglais",
        "arabic"  => "العربية",
    ];

    public function load(ObjectManager $manager)
    {
        $i = 1;
        foreach (self::LANGUAGES as $slug => $name) {
            $language = new Language();
            $language->setName($name);
            $language->setSlug($slug);
            $manager->persist($language);
            $this->addReference('language_' . $i, $language);
            $i++;
        }
        $manager->flush();
    }
}
