<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\SignupForm;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/inscription', name: 'signup')]
    public function signup(Request $request, UserRepository $repository, UserPasswordHasherInterface $passwordHasher)
    {
        $user = new User();

        $form = $this->createForm(SignupForm::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $emailExist = $repository->findOneBy(['email' => $user->getEmail()]);
            if ($emailExist) {
                return $this->redirectToRoute('isgnup', ['error' => 'USER_EXIST']);
            }
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $user->getPassword()
            );
            $user->setPassword($hashedPassword);

            $repository->save($user, true);

            return $this->redirectToRoute('', ['succes' => 'NEW_USER']);
        }
        return $this->render('pages/signup.html.twig', ['signupForm' => $form->createView()]);
    }
}