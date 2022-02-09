<?php

namespace App\Controller;

use App\Entity\Beneficiary;
use App\Entity\ServiceCategory;
use App\Entity\Service;
use App\Repository\ServiceCategoryRepository;
use App\Repository\ServiceRepository;
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
     * @Route("/home/{beneficiary}", name="home", methods={"GET"})
     * @Entity("beneficiary", expr="repository.find(beneficiary)")
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
     * @Route("/{category}/{username}", name="category", methods={"GET"})
     * @Entity("category", expr="repository.findOneBySlug(category)")
     */
    public function categoryServices(Beneficiary $beneficiary, ServiceCategory $category, ServiceCategoryRepository $serviceCategoryRepository, ServiceRepository $serviceRepository): Response
    {
        $services = $serviceRepository->findBy(
            [
                "category" => $category,
            ]
        );
        $serviceCategories = $serviceCategoryRepository->findAll();

        return $this->render('beneficiary/category.html.twig', [
            'services'           => $services,
            'beneficiary'        => $beneficiary,
            'service_categories' => $serviceCategories,
            'category'           => $category
        ]);
    }
}


