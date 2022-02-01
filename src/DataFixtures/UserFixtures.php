<?php


namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;


class UserFixtures extends Fixture implements DependentFixtureInterface
{
    CONST USER_NUMBER = 50;

    public function load(ObjectManager $manager)
    {
        $faker  =  Faker\Factory::create('en_US');
        for($i=1; $i <= 25; $i++) {
            $user = new User();
            $user->setUsername($faker->userName);
            $user->setRoles(["ROLE_USER"]);
            $user->setPassword($faker->password);
            $userType = "professional";
            $user->setType($userType);
            $manager->persist($user);
            $this->addReference("user_" . $i, $user);
        }
        for($i=26; $i <= 50; $i++) {
            $user = new User();
            $user->setUsername($faker->userName);
            $user->setRoles(["ROLE_USER"]);
            $user->setPassword($faker->password);
            $userType = "beneficiary";
            $user->setType($userType);
            $manager->persist($user);
            $this->addReference("user_" . $i, $user);
        }
        $user = new User();
        $user->setUsername("bn");
        $user->setRoles(["ROLE_ADMIN"]);
        $user->setPassword("bn");
        $user->setType('professional');
        $manager->persist($user);
        $this->addReference("user_" . (self::USER_NUMBER + 1), $user);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProfessionalFixtures::class,
            BeneficiaryFixtures::class,
        );
    }
}
