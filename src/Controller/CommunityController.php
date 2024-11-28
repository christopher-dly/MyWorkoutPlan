<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CommunityController extends AbstractController
{
    #[Route('/communaute', name: 'community')]
    public function community()
    {
        return $this->render('pages/community.html.twig');
    }
}