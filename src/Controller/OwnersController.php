<?php

namespace App\Controller;

use App\Entity\Owners;
use App\Form\OwnersType;
use App\Repository\OwnersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/owners")
 */
class OwnersController extends AbstractController
{
    /**
     * @Route("/", name="owners_index", methods={"GET"})
     */
    public function index(OwnersRepository $ownersRepository): Response
    {
        return $this->render('owners/index.html.twig', [
            'owners' => $ownersRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="owners_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $owner = new Owners();
        $form = $this->createForm(OwnersType::class, $owner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($owner);
            $entityManager->flush();

            return $this->redirectToRoute('owners_index');
        }

        return $this->render('owners/new.html.twig', [
            'owner' => $owner,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="owners_show", methods={"GET"})
     */
    public function show(Owners $owner): Response
    {
        return $this->render('owners/show.html.twig', [
            'owner' => $owner,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="owners_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Owners $owner): Response
    {
        $form = $this->createForm(OwnersType::class, $owner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('owners_index');
        }

        return $this->render('owners/edit.html.twig', [
            'owner' => $owner,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="owners_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Owners $owner): Response
    {
        if ($this->isCsrfTokenValid('delete'.$owner->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($owner);
            $entityManager->flush();
        }

        return $this->redirectToRoute('owners_index');
    }
}
