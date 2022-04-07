<?php

namespace App\Controller;

use App\Entity\Refuges;
use App\Form\RefugesType;
use App\Repository\RefugesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/refuges')]
class RefugesController extends AbstractController
{
    #[Route('/', name: 'app_refuges_index', methods: ['GET'])]
    public function index(RefugesRepository $refugesRepository): Response
    {
        return $this->render('refuges/index.html.twig', [
            'refuges' => $refugesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_refuges_new', methods: ['GET', 'POST'])]
    public function new(Request $request, RefugesRepository $refugesRepository): Response
    {
        $refuge = new Refuges();
        $form = $this->createForm(RefugesType::class, $refuge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $refugesRepository->add($refuge);
            return $this->redirectToRoute('app_refuges_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('refuges/new.html.twig', [
            'refuge' => $refuge,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_refuges_show', methods: ['GET'])]
    public function show(Refuges $refuge): Response
    {
        return $this->render('refuges/show.html.twig', [
            'refuge' => $refuge,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_refuges_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Refuges $refuge, RefugesRepository $refugesRepository): Response
    {
        $form = $this->createForm(RefugesType::class, $refuge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $refugesRepository->add($refuge);
            return $this->redirectToRoute('app_refuges_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('refuges/edit.html.twig', [
            'refuge' => $refuge,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_refuges_delete', methods: ['POST'])]
    public function delete(Request $request, Refuges $refuge, RefugesRepository $refugesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$refuge->getId(), $request->request->get('_token'))) {
            $refugesRepository->remove($refuge);
        }

        return $this->redirectToRoute('app_refuges_index', [], Response::HTTP_SEE_OTHER);
    }
}
