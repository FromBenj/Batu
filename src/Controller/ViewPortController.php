<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ViewPortController extends AbstractController
{
    /**
     * @Route("/viewport", name="viewport")
     */
    public function index(): Response
    {
        return $this->render('viewport/home.html.twig');
    }
}
