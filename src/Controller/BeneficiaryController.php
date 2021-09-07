<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/beneficiary", name="beneficiary_")
 */
class BeneficiaryController extends AbstractController
{
    /**
     * @Route("/services/example", name="servicies")
     */
    public function index(): Response
    {
        return $this->render('beneficiary/services.html.twig', [
            'controller_name' => 'BeneficiaryController',
        ]);
    }
}
