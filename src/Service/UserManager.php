<?php


namespace App\Service;


use App\Entity\Beneficiary;
use App\Entity\Professional;
use App\Entity\User;
use App\Repository\BeneficiaryRepository;
use App\Repository\ProfessionalRepository;

class UserManager
{
    private BeneficiaryRepository $beneficiaryRepository;
    private ProfessionalRepository $professionalRepository;


    public function __construct(BeneficiaryRepository $beneficiaryRepository, ProfessionalRepository $professionalRepository)
    {
        $this->beneficiaryRepository = $beneficiaryRepository;
        $this->professionalRepository = $professionalRepository;
    }


    public function getFullUser(User $user) : Beneficiary|Professional
    {
        $fullUser = $this->professionalRepository->findOneByUser($user);
        if (!$fullUser) {
            $fullUser = $this->beneficiaryRepository->findOneByUser($user);
        }


        return $fullUser;
    }
}
