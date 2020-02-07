<?php

namespace App\Controller;

use App\Entity\RhCategorieRegle;
use App\Form\RhCategorieRegleType;
use App\Repository\RhCathegorieRegleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/rh/categorie/regle")
 */
class RhCategorieRegleController extends AbstractController
{
    /**
     * @Route("/", name="rh_categorie_regle_index", methods={"GET"})
     */
    public function index(RhCathegorieRegleRepository $rhCathegorieRegleRepository): Response
    {
        return $this->render('rh_categorie_regle/index.html.twig', [
            'rh_categorie_regles' => $rhCathegorieRegleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="rh_categorie_regle_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $rhCategorieRegle = new RhCategorieRegle();
        $form = $this->createForm(RhCategorieRegleType::class, $rhCategorieRegle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($rhCategorieRegle);
            $entityManager->flush();

            return $this->redirectToRoute('rh_categorie_regle_index');
        }

        return $this->render('rh_categorie_regle/new.html.twig', [
            'rh_categorie_regle' => $rhCategorieRegle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="rh_categorie_regle_show", methods={"GET"})
     */
    public function show(RhCategorieRegle $rhCategorieRegle): Response
    {
        return $this->render('rh_categorie_regle/show.html.twig', [
            'rh_categorie_regle' => $rhCategorieRegle,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="rh_categorie_regle_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, RhCategorieRegle $rhCategorieRegle): Response
    {
        $form = $this->createForm(RhCategorieRegleType::class, $rhCategorieRegle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('rh_categorie_regle_index');
        }

        return $this->render('rh_categorie_regle/edit.html.twig', [
            'rh_categorie_regle' => $rhCategorieRegle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="rh_categorie_regle_delete", methods={"DELETE"})
     */
    public function delete(Request $request, RhCategorieRegle $rhCategorieRegle): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rhCategorieRegle->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($rhCategorieRegle);
            $entityManager->flush();
        }

        return $this->redirectToRoute('rh_categorie_regle_index');
    }
}
