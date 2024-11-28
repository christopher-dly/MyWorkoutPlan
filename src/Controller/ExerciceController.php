<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ExerciceController extends AbstractController
{
    #[Route('/categorie', name: 'category')]
    public function categorie()
    {
        return $this->render('pages/categorie.html.twig');
    }

    #[Route('/exercice', name: 'exercice')]
    public function index()
    {
        return $this->render('pages/exercice.html.twig');
    }
}