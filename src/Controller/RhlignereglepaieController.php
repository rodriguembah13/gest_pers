<?php

namespace App\Controller;

use App\Entity\Rhlignereglepaie;
use App\Form\RhlignereglepaieType;
use App\Repository\RhlignereglepaieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/rhlignereglepaie")
 */
class RhlignereglepaieController extends AbstractController
{
    /**
     * @Route("/", name="rhlignereglepaie_index", methods={"GET"})
     */
    public function index(RhlignereglepaieRepository $rhlignereglepaieRepository): Response
    {
        return $this->render('rhlignereglepaie/index.html.twig', [
            'rhlignereglepaies' => $rhlignereglepaieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="rhlignereglepaie_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $rhlignereglepaie = new Rhlignereglepaie();
        $form = $this->createForm(RhlignereglepaieType::class, $rhlignereglepaie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($rhlignereglepaie);
            $entityManager->flush();

            return $this->redirectToRoute('rhlignereglepaie_index');
        }

        return $this->render('rhlignereglepaie/new.html.twig', [
            'rhlignereglepaie' => $rhlignereglepaie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="rhlignereglepaie_show", methods={"GET"})
     */
    public function show(Rhlignereglepaie $rhlignereglepaie): Response
    {
        return $this->render('rhlignereglepaie/show.html.twig', [
            'rhlignereglepaie' => $rhlignereglepaie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="rhlignereglepaie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Rhlignereglepaie $rhlignereglepaie): Response
    {
        $form = $this->createForm(RhlignereglepaieType::class, $rhlignereglepaie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('rhlignereglepaie_index');
        }

        return $this->render('rhlignereglepaie/edit.html.twig', [
            'rhlignereglepaie' => $rhlignereglepaie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="rhlignereglepaie_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Rhlignereglepaie $rhlignereglepaie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rhlignereglepaie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($rhlignereglepaie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('rhlignereglepaie_index');
    }
}
