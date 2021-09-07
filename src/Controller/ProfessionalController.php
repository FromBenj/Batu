<?php

namespace App\Controller;

use App\Entity\Service;
use App\Form\ServiceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/professional", name="professional_")
 */
class ProfessionalController extends AbstractController
{
    /**
     * @Route("/new-service", name="new-service")
     */
    public function index(): Response
    {
        $service = new Service();
        $serviceForm = $this->createForm(ServiceType::class, $service);
        return $this->render('professional/new-service.html.twig', [
            'form_service' => $serviceForm->createView(),
        ]);
    }
}
