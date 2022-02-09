<?php

namespace App\Controller;

use App\Entity\Professional;
use App\Entity\Service;
use App\Form\ServiceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;

/**
 * @Route("/professional", name="professional_")
 */
class ProfessionalController extends AbstractController
{
    /**
     * @Route("/dashboard/{professional}", name="dashboard")
     * @Entity("professional", expr="repository.find(professional)")
     */
    public function index(Professional $professional): Response
    {
        return $this->render('professional/dashboard.html.twig', [
            'professional' => $professional,
        ]);
    }

        /**
     * @Route("/new-service", name="new-service")
     */
    public function newService(Request $request): Response
    {
        $service = new Service();
        $serviceForm = $this->createForm(ServiceType::class, $service);
        $serviceForm->handleRequest($request);

        if ($serviceForm->isSubmitted() && $serviceForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($service);
            $entityManager->flush();
        }


        return $this->render('professional/new-service.html.twig', [
            'form_service' => $serviceForm->createView(),
        ]);
    }
}
