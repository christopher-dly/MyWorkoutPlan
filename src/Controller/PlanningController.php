<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PlanningController extends AbstractController
{
    #[Route('/mesPlanning', name: 'myPlanning')]
    public function mesPlanning()
    {
        return $this->render('pages/mesPlanning.html.twig');
    }

    #[Route('/planning/{name}', name: 'planning')]
    public function planning()
    {
        return $this->render('pages/planning.html.twig');
    }
}