<?php

namespace App\Controller;

use App\Entity\Story;
use App\Form\StoryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MemberController extends AbstractController
{
    #[Route('/member', name: 'app_member')]
    public function show(EntityManagerInterface $entityManager): Response
    {
        $stories = $entityManager->getRepository(Story::class)->findAll();

        return $this->render('member/index.html.twig', [
            'stories' => $stories,
        ]);
    }
    #[Route('/add', name: 'app_add')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        // just set up a fresh $task object (remove the example data)
        $story = new Story();

        $form = $this->createForm(StoryType::class, $story);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $story = $form->getData();

            $entityManager->persist($story);
            $entityManager->flush();

            return $this->redirectToRoute('app_member');
        }

        return $this->render('member/addstory.html.twig', [
            'form' => $form,
        ]);
    }
    #[Route('/update', name: 'app_update')]
    public function updatelesson(EntityManagerInterface $em,int $id, Request $request): Response
    {

        $lesson = $em->getRepository(Story::class)->find($id);
        $form = $this->createForm(StoryType::class, $lesson);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $task = $form->getData();
            $em->flush();
            // ... perform some action, such as saving the task to the database

            return $this->redirectToRoute('app_home_teacher');
        }

        return $this->render('teacher/addlesson.html.twig', [
            'form' => $form,
        ]);
    }
}
