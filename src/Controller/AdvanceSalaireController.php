<?php

namespace App\Controller;

use App\Entity\AdvanceSalaire;
use App\Form\AdvanceSalaireType;
use App\Repository\AdvanceSalaireRepository;
use App\Repository\EmployeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/advance/salaire")
 */
class AdvanceSalaireController extends AbstractController
{
    /**
     * @Route("/", name="advance_salaire_index", methods={"GET"})
     */
    public function index(AdvanceSalaireRepository $advanceSalaireRepository): Response
    {
        return $this->render('advance_salaire/index.html.twig', [
            'advance_salaires' => $advanceSalaireRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="advance_salaire_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $advanceSalaire = new AdvanceSalaire();
        $form = $this->createForm(AdvanceSalaireType::class, $advanceSalaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($advanceSalaire);
            $entityManager->flush();

            return $this->redirectToRoute('advance_salaire_index');
        }

        return $this->render('advance_salaire/new.html.twig', [
            'advance_salaire' => $advanceSalaire,
            'form' => $form->createView(),
            'statut' => 'create',
        ]);
    }

    /**
     * @Route("/{id}", name="advance_salaire_show", methods={"GET"})
     */
    public function show(AdvanceSalaire $advanceSalaire): Response
    {
        return $this->render('advance_salaire/show.html.twig', [
            'advance_salaire' => $advanceSalaire,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="advance_salaire_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AdvanceSalaire $advanceSalaire): Response
    {
        $form = $this->createForm(AdvanceSalaireType::class, $advanceSalaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('advance_salaire_index');
        }

        return $this->render('advance_salaire/edit.html.twig', [
            'advance_salaire' => $advanceSalaire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="advance_salaire_edit", methods={"GET","POST"})
     */
    public function makeEcheance(Request $request, AdvanceSalaire $advanceSalaire): Response
    {
        $form = $this->createForm(AdvanceSalaireType::class, $advanceSalaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('advance_salaire_index');
        }

        return $this->render('advance_salaire/edit.html.twig', [
            'advance_salaire' => $advanceSalaire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="advance_salaire_delete", methods={"DELETE"})
     */
    public function delete(Request $request, AdvanceSalaire $advanceSalaire): Response
    {
        if ($this->isCsrfTokenValid('delete'.$advanceSalaire->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($advanceSalaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('advance_salaire_index');
    }

    public function postJsonAdvance(Request $request, EmployeRepository $employeRepository, AdvanceSalaireRepository $salaireRepository): JsonResponse
    {
        $employe = $employeRepository->find($request->query->get('employe'));
        if (null == $salaireRepository->findBy(['employe' => $employe, 'status' => false])) {
            $advance = new AdvanceSalaire();
            $advance->setMontant($request->query->get('montant'));
            $advance->setEchance($request->query->get('echeance'));
            $advance->setEmploye($employe);
            $advance->setCreated(new \DateTime());
            $advance->setMontantRestant($request->query->get('montant'));
            $advance->setStatus(false);
            $advance->setUser($this->getUser());
            $date_ = new \DateTime();
            $month = (int) date('m', strtotime($date_->format('y-m-d')));
            $year = (int) date('y', strtotime($date_->format('y-m-d')));
            $advance->setMonth($month);
            $advance->setYear($year);
            $advance->setLibelle('ADV-'.$employe->getNomComplet());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($advance);
            $entityManager->flush();
            $responseArray[] = [
                'id' => $advance->getId(),
            ];

            return new JsonResponse($responseArray);
        } else {
            return new JsonResponse(null, 400);
        }
    }
}
