<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class AdventureController extends AbstractController
{
    #[Route('/', name: 'app_adventure')]
    public function index(): Response
    {
        return $this->render('adventure/index.html.twig', [
            'controller_name' => 'AdventureController',
        ]);
    }

    #[Route('/register', name: 'register')]
    public function register(EntityManagerInterface $entityManager, Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        $register = new User();

        $form = $this->createForm(RegisterType::class, $register);
        $form->remove('iban');
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $register = $form->getData();
            $hashedPassword = $passwordHasher->hashPassword($register, $register->getPassword());
            $register->setPassword($hashedPassword);
            $register->setRoles(["ROLE_MEMBER"]);

            $entityManager->persist($register);
            $entityManager->flush();
            // ... perform some action, such as saving the task to the database

            return $this->redirectToRoute('app_login');
        }
        return $this->render('adventure/register.html.twig', [
            'form' => $form,
        ]);
    }
}
