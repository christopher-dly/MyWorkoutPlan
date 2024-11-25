<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Form\ConnectForm;

class HomeController extends AbstractController
{
    #[Route('/', name: 'connexion')]
    public function accueil(AuthenticationUtils $authenticationUtils)
    {
        $form = $this->createForm(ConnectForm::class);

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastEmail = $authenticationUtils->getLastUsername();

        return $this->render('pages/index.html.twig', [
            'last_Email' => $lastEmail,
            'error' => $error,
            'connexionForm' => $form->createView()
        ]);
    }
}
