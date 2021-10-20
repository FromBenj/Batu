<?php

namespace App\DataFixtures;

use App\Entity\Appointment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;
use \DateTime;
use DateInterval;

class AppointmentFixtures extends Fixture implements DependentFixtureInterface
{

    CONST APPOINTMENT_NUMBER = 50;

    public function load(ObjectManager $manager)
    {
        for($i=1; $i<=50; $i++) {
            $faker = Faker\Factory::create('en_US');
            $appointment = new Appointment();
            $appointment->setBeneficiary($this->getReference('beneficiary_' . rand(1, BeneficiaryFixtures::BENEFICIARY_NUMBER)));
            $appointment->setProfessional($this->getReference('professional_' . rand(1, ProfessionalFixtures::PROFESSIONAL_NUMBER)));
            $appointment->setCanceled(rand(0,1));
            $now = new DateTime();
            $startingTime = $now->add(new DateInterval("PT18H3M"));
            $appointment->setStartingTime($startingTime);
            $then = new DateTime();
            $endingTime = $then->add(new DateInterval('PT18H48M'));
            $appointment->setEndingTime($endingTime);
            $manager->persist($appointment);
        }
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
