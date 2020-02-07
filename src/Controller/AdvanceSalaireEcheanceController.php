<?php

namespace App\Controller;

use App\Entity\AdvanceSalaireEcheance;
use App\Form\AdvanceSalaireEcheanceType;
use App\Repository\AdvanceSalaireEcheanceRepository;
use App\Repository\AdvanceSalaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/advance/salaire/echeance")
 */
class AdvanceSalaireEcheanceController extends AbstractController
{
    /**
     * @Route("/", name="advance_salaire_echeance_index", methods={"GET"})
     */
    public function index(AdvanceSalaireEcheanceRepository $advanceSalaireEcheanceRepository): Response
    {
        return $this->render('advance_salaire_echeance/index.html.twig', [
            'advance_salaire_echeances' => $advanceSalaireEcheanceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="advance_salaire_echeance_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $advanceSalaireEcheance = new AdvanceSalaireEcheance();
        $form = $this->createForm(AdvanceSalaireEcheanceType::class, $advanceSalaireEcheance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($advanceSalaireEcheance);
            $entityManager->flush();

            return $this->redirectToRoute('advance_salaire_echeance_index');
        }

        return $this->render('advance_salaire_echeance/new.html.twig', [
            'advance_salaire_echeance' => $advanceSalaireEcheance,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="advance_salaire_echeance_show", methods={"GET"})
     */
    public function show(AdvanceSalaireEcheance $advanceSalaireEcheance): Response
    {
        return $this->render('advance_salaire_echeance/show.html.twig', [
            'advance_salaire_echeance' => $advanceSalaireEcheance,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="advance_salaire_echeance_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AdvanceSalaireEcheance $advanceSalaireEcheance): Response
    {
        $form = $this->createForm(AdvanceSalaireEcheanceType::class, $advanceSalaireEcheance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('advance_salaire_echeance_index');
        }

        return $this->render('advance_salaire_echeance/edit.html.twig', [
            'advance_salaire_echeance' => $advanceSalaireEcheance,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="advance_salaire_echeance_delete", methods={"DELETE"})
     */
    public function delete(Request $request, AdvanceSalaireEcheance $advanceSalaireEcheance): Response
    {
        if ($this->isCsrfTokenValid('delete'.$advanceSalaireEcheance->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($advanceSalaireEcheance);
            $entityManager->flush();
        }

        return $this->redirectToRoute('advance_salaire_echeance_index');
    }

    public function postJsonAdvanceEcheance(Request $request, AdvanceSalaireRepository $advanceSalaireRepository): JsonResponse
    {
        $advance = new AdvanceSalaireEcheance();
        $advance->setMontant($request->query->get('montant'));
        $advance->setMonth($request->query->get('month'));
        $advance->setAdvanceSalaire($advanceSalaireRepository->find($request->query->get('advance')));
        $advance->setYear(20);
        $advance->setStatut(false);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($advance);
        $entityManager->flush();
        $responseArray[] = [
            'id' => $advance->getId(),
        ];

        return new JsonResponse($responseArray);
    }
}
