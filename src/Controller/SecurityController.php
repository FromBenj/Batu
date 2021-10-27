<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    /**
     * @Route("/", name="welcome")
     */
    public function welcome(): Response
    {
        return $this->render('security/index.html.twig', [
        ]);
    }
}
