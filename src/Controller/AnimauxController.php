<?php

namespace App\Controller;

use App\Entity\Animaux;
use App\Form\AnimauxType;
use App\Repository\AnimauxRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/animaux')]
class AnimauxController extends AbstractController
{
    #[Route('/', name: 'app_animaux_index', methods: ['GET'])]
    public function index(AnimauxRepository $animauxRepository): Response
    {
        return $this->render('animaux/index.html.twig', [
            'animauxes' => $animauxRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_animaux_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AnimauxRepository $animauxRepository): Response
    {
        $animaux = new Animaux();
        $form = $this->createForm(AnimauxType::class, $animaux);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $animauxRepository->add($animaux);
            return $this->redirectToRoute('app_animaux_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('animaux/new.html.twig', [
            'animaux' => $animaux,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_animaux_show', methods: ['GET'])]
    public function show(Animaux $animaux): Response
    {
        return $this->render('animaux/show.html.twig', [
            'animaux' => $animaux,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_animaux_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Animaux $animaux, AnimauxRepository $animauxRepository): Response
    {
        $form = $this->createForm(AnimauxType::class, $animaux);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $animauxRepository->add($animaux);
            return $this->redirectToRoute('app_animaux_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('animaux/edit.html.twig', [
            'animaux' => $animaux,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_animaux_delete', methods: ['POST'])]
    public function delete(Request $request, Animaux $animaux, AnimauxRepository $animauxRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$animaux->getId(), $request->request->get('_token'))) {
            $animauxRepository->remove($animaux);
        }

        return $this->redirectToRoute('app_animaux_index', [], Response::HTTP_SEE_OTHER);
    }
}
