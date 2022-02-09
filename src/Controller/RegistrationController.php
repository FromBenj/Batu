<?php

namespace App\Controller;

use App\Entity\Beneficiary;
use App\Entity\Professional;
use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setUsername($form->getData()['username']);
            // encode the plain password
            $user->setPassword(
            $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $userType = $form->getData()['userType'];
            if (in_array($userType, $user::USER_TYPES, true)) {
                if ($userType === 'professional') {
                    $professional = new Professional($user);
                    $entityManager->persist($user);
                    $entityManager->persist($professional);
                    $entityManager->flush();
                }
                if ($userType === 'beneficiary') {
                    $beneficiary = new Beneficiary($user);
                    $entityManager->persist($user);
                    $entityManager->persist($beneficiary);
                    $entityManager->flush();
                }

            }

            return $this->redirectToRoute('login');
        }

        return $this->render('registration/register.html.twig', [
            'form_registration' => $form->createView(),
        ]);
    }
}
