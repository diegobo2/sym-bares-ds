<?php

namespace App\Controller;

use App\Entity\Bares;
use App\Form\BaresType;
use App\Repository\BaresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bares")
 */
class BaresController extends AbstractController
{
    /**
     * @Route("/", name="bares_index", methods={"GET"})
     */
    public function index(BaresRepository $baresRepository): Response
    {
        return $this->render('base.html.twig', [
            'bares' => $baresRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="bares_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $bare = new Bares();
        $form = $this->createForm(BaresType::class, $bare);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bare);
            $entityManager->flush();

            return $this->redirectToRoute('bares_index');
        }

        return $this->render('bares/new.html.twig', [
            'bare' => $bare,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bares_show", methods={"GET"})
     */
    public function show(Bares $bare): Response
    {
        return $this->render('bares/show.html.twig', [
            'bare' => $bare,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bares_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Bares $bare): Response
    {
        $form = $this->createForm(BaresType::class, $bare);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bares_index');
        }

        return $this->render('bares/edit.html.twig', [
            'bare' => $bare,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bares_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Bares $bare): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bare->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($bare);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bares_index');
    }
}
