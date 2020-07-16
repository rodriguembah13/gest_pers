<?php

namespace App\Controller;

use App\Entity\Activity;
use App\Entity\Employe;
use App\Entity\Project;
use App\Entity\Timesheet;
use App\Form\TimesheetActivityType;
use App\Form\TimesheetType;
use App\Repository\TimesheetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/timesheet")
 */
class TimesheetController extends AbstractController
{
    /**
     * @Route("/", name="timesheet_index", methods={"GET"})
     */
    public function index(TimesheetRepository $timesheetRepository): Response
    {
        return $this->render('timesheet/index.html.twig', [
            'timesheets' => $timesheetRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}/project", name="timesheet_project", methods={"GET"})
     */
    public function project_index(Project $project, TimesheetRepository $timesheetRepository): Response
    {
        return $this->render('timesheet/index.html.twig', [
            'timesheets' => $timesheetRepository->findBy(['project' => $project]),
        ]);
    }

    /**
     * @Route("/{id}/activity", name="timesheet_activity", methods={"GET"})
     */
    public function activity_index(Activity $activity, TimesheetRepository $timesheetRepository): Response
    {
        return $this->render('timesheet/index.html.twig', [
            'timesheets' => $timesheetRepository->findBy(['activity' => $activity]),
        ]);
    }

    /**
     * @Route("/mytimesheet", name="timesheet_user", methods={"GET"})
     */
    public function myTimesheet(TimesheetRepository $timesheetRepository): Response
    {
        $employe = $this->getUser()->getEmploye();

        return $this->render('timesheet/mytimesheet.html.twig', [
            'timesheets' => $timesheetRepository->findBy(['employe' => $employe]),
        ]);
    }

    /**
     * @Route("/new", name="timesheet_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $timesheet = new Timesheet();
        $employe = $this->getUser()->getEmploye();
        $form = $this->createForm(TimesheetType::class, $timesheet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $timesheet->setEmploye($employe);
            if (null === $timesheet->getDateFin()) {
                $timesheet->setStatut('open');
            } else {
                $timesheet->setStatut('close');
            }
            $entityManager->persist($timesheet);
            $entityManager->flush();

            return $this->redirectToRoute('timesheet_user');
        }

        return $this->render('timesheet/new.html.twig', [
            'timesheet' => $timesheet,
            'employe' => $employe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/newactivity", name="timesheet_activity_new", methods={"GET","POST"})
     */
    public function newByActivity(Activity $activity, Request $request): Response
    {
        $timesheet = new Timesheet();
        $employe = $this->getUser()->getEmploye();
        $form = $this->createForm(TimesheetActivityType::class, $timesheet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $timesheet->setEmploye($employe);
            $timesheet->setProject($activity->getProject());
            if (null === $timesheet->getDateFin()) {
                $timesheet->setStatut('open');
            } else {
                $timesheet->setStatut('close');
            }
            $timesheet->setActivity($activity);
            $entityManager->persist($timesheet);
            $entityManager->flush();

            return $this->redirectToRoute('timesheet_user');
        }

        return $this->render('timesheet/new_by_activity.html.twig', [
            'timesheet' => $timesheet,
            'employe' => $employe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/newbyemploye/{id}", name="timesheet_employe_new", methods={"GET","POST"})
     */
    public function newByEmploye(Request $request, Employe $employe): Response
    {
        $timesheet = new Timesheet();
        $form = $this->createForm(TimesheetType::class, $timesheet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $timesheet->setEmploye($employe);
            if (null === $timesheet->getDateFin()) {
                $timesheet->setStatut('open');
            } else {
                $timesheet->setStatut('close');
            }
            $entityManager->persist($timesheet);
            $entityManager->flush();

            return $this->redirectToRoute('timesheet_index');
        }

        return $this->render('timesheet/new.html.twig', [
            'timesheet' => $timesheet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="timesheet_show", methods={"GET"})
     */
    public function show(Timesheet $timesheet): Response
    {
        return $this->render('timesheet/show.html.twig', [
            'timesheet' => $timesheet,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="timesheet_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Timesheet $timesheet): Response
    {
        $form = $this->createForm(TimesheetType::class, $timesheet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (null === $timesheet->getDateFin()) {
                $timesheet->setStatut('open');
            } else {
                $timesheet->setStatut('close');
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('timesheet_index');
        }

        return $this->render('timesheet/edit.html.twig', [
            'timesheet' => $timesheet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="timesheet_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Timesheet $timesheet): Response
    {
        if ($this->isCsrfTokenValid('delete'.$timesheet->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($timesheet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('timesheet_index');
    }
}
