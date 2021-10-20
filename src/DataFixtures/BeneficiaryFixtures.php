<?php


namespace App\DataFixtures;

use App\Entity\Beneficiary;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;


class BeneficiaryFixtures extends Fixture
{
    CONST BENEFICIARY_NUMBER = 50;

    public function load(ObjectManager $manager)
    {
        $faker  =  Faker\Factory::create('en_US');
        for($i=1; $i <= self::BENEFICIARY_NUMBER; $i++) {
            $beneficiary = new Beneficiary();
            $beneficiary->setUsername($faker->userName);
            $beneficiary->setRoles(["ROLE_USER"]);
            $beneficiary->setPassword($faker->password);
            $manager->persist($beneficiary);
            $this->addReference("beneficiary_" . $i, $beneficiary);
        }
        $beneficiary = new Beneficiary();
        $beneficiary->setUsername("Ben");
        $beneficiary->setRoles(["ROLE_ADMIN"]);
        $beneficiary->setPassword($faker->password);
        $manager->persist($beneficiary);
        $this->addReference("beneficiary_" . (self::BENEFICIARY_NUMBER + 1), $beneficiary);

        $manager->flush();
    }

}
