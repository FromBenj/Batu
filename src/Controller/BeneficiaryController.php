<?php

namespace App\Controller;

use App\Entity\Beneficiary;
use App\Entity\ServiceCategory;
use App\Entity\Service;
use App\Repository\ServiceCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;

/**
 * @Route("/beneficiary", name="beneficiary_")
 */
class BeneficiaryController extends AbstractController
{
    /**
     * @Route("/home/{username}", name="home", methods={"GET"})
     */
    public function index(Beneficiary $beneficiary, ServiceCategoryRepository $serviceCategoryRepository): Response
    {
        $serviceCategories = $serviceCategoryRepository->findAll();
        return $this->render('beneficiary/home.html.twig', [
            'beneficiary'        => $beneficiary,
            'service_categories' => $serviceCategories,
        ]);
    }

    /**
     * @Route("/home/{username}/{category}", name="category", methods={"GET"})
     * @Entity("category", expr="repository.findOneByName(category)")
     */
    public function categoryServices(Beneficiary $beneficiary, ServiceCategory $category, ServiceCategoryRepository $serviceCategoryRepository): Response
    {
        $serviceCategories = $serviceCategoryRepository->findAll();
        return $this->render('beneficiary/category.html.twig', [
            'beneficiary'        => $beneficiary,
            'service_categories' => $serviceCategories,
            'category'           => $category
        ]);
    }






    /**
     * @Route("/services/example", name="servicies")
     */
    public function example(): Response
    {
        return $this->render('beneficiary/services.html.twig', [
            'controller_name' => 'BeneficiaryController',
        ]);
    }
}
