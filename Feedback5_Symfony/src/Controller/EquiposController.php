<?php

namespace App\Controller;

use App\Entity\Equipos;
use App\Form\EquiposType;
use App\Repository\EquiposRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/equipos')]
class EquiposController extends AbstractController
{
    #[Route('/', name: 'app_equipos_index', methods: ['GET'])]
    public function index(EquiposRepository $equiposRepository): Response
    {
        return $this->render('equipos/index.html.twig', [
            'equipos' => $equiposRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_equipos_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $equipo = new Equipos();
        $form = $this->createForm(EquiposType::class, $equipo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($equipo);
            $entityManager->flush();

            return $this->redirectToRoute('app_equipos_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('equipos/new.html.twig', [
            'equipo' => $equipo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_equipos_show', methods: ['GET'])]
    public function show(Equipos $equipo): Response
    {
        return $this->render('equipos/show.html.twig', [
            'equipo' => $equipo,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_equipos_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Equipos $equipo, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EquiposType::class, $equipo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_equipos_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('equipos/edit.html.twig', [
            'equipo' => $equipo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_equipos_delete', methods: ['POST'])]
    public function delete(Request $request, Equipos $equipo, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$equipo->getId(), $request->request->get('_token'))) {
            $entityManager->remove($equipo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_equipos_index', [], Response::HTTP_SEE_OTHER);
    }
}
