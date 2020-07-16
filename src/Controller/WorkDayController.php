<?php

namespace App\Controller;

use App\Entity\Entreprise;
use App\Entity\WorkDay;
use App\Form\WorkDayType;
use App\Repository\WorkDayRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/work/day")
 */
class WorkDayController extends AbstractController
{
    /**
     * @Route("/", name="work_day_index", methods={"GET"})
     */
    public function index(WorkDayRepository $workDayRepository): Response
    {
        return $this->render('work_day/index.html.twig', [
            'work_days' => $workDayRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="work_day_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $workDay = new WorkDay();
        $form = $this->createForm(WorkDayType::class, $workDay);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($workDay);
            $entityManager->flush();

            return $this->redirectToRoute('work_day_index');
        }

        return $this->render('work_day/new.html.twig', [
            'work_day' => $workDay,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/new", name="work_day_new_entreprise", methods={"GET","POST"})
     */
    public function new_entreprise(Request $request, Entreprise $entreprise): Response
    {
        $workDay = new WorkDay();
        $form = $this->createForm(WorkDayType::class, $workDay);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $workDay->setEntreprise($entreprise);
            $entityManager->persist($workDay);
            $entityManager->flush();

            return $this->redirectToRoute('entreprise_workday', ['id' => $entreprise->getId()]);
        }

        return $this->render('work_day/new.html.twig', [
            'work_day' => $workDay,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="work_day_show", methods={"GET"})
     */
    public function show(WorkDay $workDay): Response
    {
        return $this->render('work_day/show.html.twig', [
            'work_day' => $workDay,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="work_day_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, WorkDay $workDay): Response
    {
        $form = $this->createForm(WorkDayType::class, $workDay);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('work_day_index');
        }

        return $this->render('work_day/edit.html.twig', [
            'work_day' => $workDay,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="work_day_delete", methods={"DELETE"})
     */
    public function delete(Request $request, WorkDay $workDay): Response
    {
        if ($this->isCsrfTokenValid('delete'.$workDay->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($workDay);
            $entityManager->flush();
        }

        return $this->redirectToRoute('work_day_index');
    }
}
