<?php

namespace App\Controller;

use App\Entity\Story;
use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/admindelete/{id}', name: 'app_delete')]
    public function delete(EntityManagerInterface $entityManager,int $id): Response
    {
        $story = $entityManager->getRepository(Story::class)->find($id);
        $entityManager->remove($story);
        $entityManager->flush();

       return $this->redirectToRoute('app_admin');
    }
    #[Route('/adminadd', name: 'app_docentadd')]
    public function add(EntityManagerInterface $entityManager, int $id, Request $request): Response
    {
        $user = new User();

        $form = $this->createForm(RegisterType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $task = $form->getData();
            return $this->redirectToRoute('app_admin');
        }

        return $this->render('admin/newdocent.html.twig', [
            'form' => $form,
        ]);
    }


}
