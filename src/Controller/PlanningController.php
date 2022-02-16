<?php

namespace App\Controller;

use App\Entity\Planning;
use App\Entity\Slot;
use App\Form\SlotType;
use App\Repository\PlanningRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlanningController extends AbstractController
{
    #[Route('professional/planning', name: 'planning')]
    public function index(Request $request, ManagerRegistry $doctrine, PlanningRepository $planningRepository): Response
    {
        $user = $this->getUser();
        $slot = new Slot();
        $slotForm = $this->createForm(SlotType::class, $slot);
        $slotForm->handleRequest($request);

        if ($slotForm->isSubmitted() && $slotForm->isValid()) {
            $planning = $planningRepository->findByUser($user);
            $slot->setPlanning($planning);
            $entityManager = $doctrine->getManager();
            $entityManager->persist($slot);
            $entityManager->flush();
        }

        $weekDays = Planning::WEEK_DAYS;
        return $this->render('planning/index.html.twig', [
            'week_days' => $weekDays,
            'slot_form' => $slotForm->createView(),
        ]);
    }
}
