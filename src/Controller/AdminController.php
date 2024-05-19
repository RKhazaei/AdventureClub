<?php

namespace App\Controller;

use App\Entity\Story;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function show(EntityManagerInterface $entityManager): Response
    {
        $story = $entityManager->getRepository(Story::class)->findAll();

        return $this->render('admin/index.html.twig', [
            'stories' => $story,
        ]);
    }

    #[Route('/admindelete{id}', name: 'app_delete')]
    public function delete(EntityManagerInterface $entityManager,int $id): Response
    {
        $story = $entityManager->getRepository(Story::class)->find($id);
        $entityManager->remove($story);
        $entityManager->flush();

        return $this->render('admin/index.html.twig', [
            'stories' => $story,
        ]);
    }
}
