<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    #[Route('/', name: 'login')]
    public function index(AuthenticationUtils $authenticationUtils, UserManager $userManager): Response|RedirectResponse
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        if ($this->getUser()) {
            $this->redirectToRoute('dispatch');
        }

        return $this->render('login/index.html.twig', [
            'last_username'   => $lastUsername,
            'error'           => $error,
        ]);
    }

    #[Route('/dispatch/', name: 'dispatch')]
    public function dispatch(UserManager $userManager): RedirectResponse
    {
        $user = $this->getUser();
        $fullUser = $userManager->getFullUser($user);
        $fullUserClass = get_class($fullUser);
        $fullUserId = $fullUser->getId();
        if($fullUserClass === 'Beneficiary') {
            $this->redirectToRoute('beneficiary_home', ['beneficiary' => $fullUserId]);
        } elseif ($fullUserClass === 'professional') {
            $this->redirectToRoute('professional_dashboard', ['professional' => $fullUserId]);
        } else {
            $this->redirectToRoute('login');
        }
    }
}
