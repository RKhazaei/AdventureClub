<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

                // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/index.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }
    #[Route('/logout', name: 'app_logout')]
    public function logout(): Response
    {
        return $this->redirectToRoute("app_adventure");
    }
    #[Route('/redirect', name: 'app_redirect')]
    public function redirectAction(Security $security)
    {
        if ($security->isGranted("ROLE_ADMIN")) {
            $this->redirectToRoute("app_adventure");
        }
        if ($security->isGranted("ROLE_MEMBER")) {
            $this->redirectToRoute("app_adventure");
        }
        if ($security->isGranted("ROLE_DOCENT")) {
            $this->redirectToRoute("app_adventure");
        }
        return $this->redirectToRoute("app_adventure");
    }

}
