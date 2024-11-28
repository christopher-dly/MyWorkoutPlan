<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'profil')]
    public function profil()
    {
        return $this->render('pages/profil.html.twig');
    }

    #[Route('/mesInfos', name: 'myInfos')]
    public function myInfos()
    {
        return $this->render('pages/mesInfos.html.twig');
    }
    
    #[Route('/historiquePlannings', name: 'historicalPlanning')]
    public function historicalPlanning()
    {
        return $this->render('pages/historiquePlanning.html.twig');
    }

    #[Route('/historique/{name}', name: 'historicalNamePlanning')]
    public function historicalNamePlanning()
    {
        return $this->render('pages/hitoriqueNomPlanning.html.twig');
    }
}