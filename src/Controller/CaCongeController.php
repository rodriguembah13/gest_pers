<?php

namespace App\Controller;

use App\Entity\CaConge;
use App\Form\CaCongeType;
use App\Form\MyCaCongeType;
use App\Repository\CaCongeRepository;
use App\Repository\HolidayRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ca/conge")
 */
class CaCongeController extends AbstractController
{
    /**
     * @Route("/", name="ca_conge_index", methods={"GET"})
     */
    public function index(CaCongeRepository $caCongeRepository): Response
    {
        return $this->render('ca_conge/index.html.twig', [
            'ca_conges' => $caCongeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/a_valider", name="ca_conge_a_avider", methods={"GET"})
     */
    public function congesavalider(CaCongeRepository $caCongeRepository): Response
    {
        return $this->render('ca_conge/avalider.html.twig', [
            'ca_conges' => $caCongeRepository->findByStaut('approuve'),
        ]);
    }

    /**
     * @Route("/myconge", name="ca_conge_my", methods={"GET"})
     */
    public function myconge(CaCongeRepository $caCongeRepository): Response
    {
        $employe = $this->getUser()->getEmploye();

        return $this->render('ca_conge/myconge.html.twig', [
            'ca_conges' => $caCongeRepository->findBy(['employe' => $employe]),
            'employes' => $employe,
        ]);
    }

    /**
     * @Route("/new", name="ca_conge_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $caConge = new CaConge();
        $form = $this->createForm(CaCongeType::class, $caConge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $libelle = $caConge->getType()->getLibelle().'-'.$caConge->getEmploye()->getNomComplet();
            $caConge->setLibelle($libelle);
            $caConge->setStatus('approuve');
            $entityManager->persist($caConge);
            $entityManager->flush();

            return $this->redirectToRoute('ca_conge_index');
        }

        return $this->render('ca_conge/new.html.twig', [
            'ca_conge' => $caConge,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/mynew", name="ca_conge_my_new", methods={"GET","POST"})
     */
    public function mynewconge(Request $request): Response
    {
        $caConge = new CaConge();
        $form = $this->createForm(MyCaCongeType::class, $caConge);
        $form->handleRequest($request);
        $employe = $this->getUser()->getEmploye();
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $caConge->setEmploye($employe);
            $libelle = $caConge->getType()->getLibelle().'-'.$caConge->getEmploye()->getNomComplet();
            $caConge->setLibelle($libelle);
            $caConge->setStatus('approuve');
            $entityManager->persist($caConge);
            $entityManager->flush();

            return $this->redirectToRoute('ca_conge_my');
        }

        return $this->render('ca_conge/mynew.html.twig', [
            'ca_conge' => $caConge,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ca_conge_show", methods={"GET"})
     */
    public function show(CaConge $caConge): Response
    {
        return $this->render('ca_conge/show.html.twig', [
            'ca_conge' => $caConge,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ca_conge_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CaConge $caConge): Response
    {
        $form = $this->createForm(CaCongeType::class, $caConge);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $libelle = $caConge->getType()->getLibelle().'-'.$caConge->getEmploye()->getNomComplet();
            $caConge->setLibelle($libelle);
            //$caConge->setStatus('approuve');
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ca_conge_index');
        }

        return $this->render('ca_conge/edit.html.twig', [
            'ca_conge' => $caConge,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/update", name="ca_conge_update", methods={"GET","POST"})
     */
    public function changeStatut(Request $request, CaConge $caConge, CaCongeRepository $caCongeRepository): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        if ('approuve' == $caConge->getStatus()) {
            $caConge->setStatus('valide');
        } elseif ('valide' === $caConge->getStatus()) {
            $caConge->setStatus('confirme');
        } elseif ('annuler' === $caConge->getStatus()) {
            $caConge->setStatus('annule');
        }
        $entityManager->persist($caConge);
        $entityManager->flush();

        return $this->render('ca_conge/avalider.html.twig', [
            'ca_conges' => $caCongeRepository->findByStaut('approuve'),
        ]);
    }

    /**
     * @Route("/{id}", name="ca_conge_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CaConge $caConge): Response
    {
        if ($this->isCsrfTokenValid('delete'.$caConge->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($caConge);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ca_conge_index');
    }

    /**
     * Returns a JSON string with the caconge of the CaConge with the providen id.
     */
    public function update(Request $request, CaCongeRepository $caCongeRepository): JsonResponse
    {
        // Get Entity manager and repository
        $entityManager = $this->getDoctrine()->getManager();
        $conge = $caCongeRepository->find($request->query->get('congeid'));
        if ('confimer' == $request->query->get('congestatus')) {
            $conge->setStatus('confirme');
        } elseif ('valider' === $request->query->get('congestatus')) {
            $conge->setStatus('valide');
        } elseif ('annuler' === $request->query->get('congestatus')) {
            $conge->setStatus('annule');
        }
        $entityManager->persist($conge);
        $entityManager->flush();

        return new JsonResponse($conge);
    }

    /**
     * Returns a JSON string with the neighborhoods of the City with the providen id.
     */
    public function updateNumberDay(Request $request, HolidayRepository $holidayRepository): JsonResponse
    {
        // Get Entity manager and repository
        $em = $this->getDoctrine()->getManager();
        // $neighborhoodsRepository = $em->getRepository('AppBundle:Neighborhood');
        $dateBegin = \DateTime::createFromFormat('Y-m-d', $request->get('dateBegin'));
        $dateEnd = \DateTime::createFromFormat('Y-m-d', $request->get('dateEnd'));
        $holiday = $holidayRepository->findByBetweenDate($dateBegin, $dateEnd);
        $weekend = $this->getNumberOfWeekendDays($dateBegin, $dateEnd);
        $daysBetweenStartAndEnd = $dateEnd->diff($dateBegin)->days;
        $responseArray = [];
        $responseArray[] = [
            'nombrejour' => $daysBetweenStartAndEnd,
        ];
        $nombre_jour = $daysBetweenStartAndEnd- (count($holiday) + $weekend) ;

        //return new JsonResponse($responseArray);
        return new JsonResponse(['nombrejour' => $nombre_jour], 200);
    }

    private function getNumberOfWeekendDays(\DateTimeInterface $startDate, \DateTimeInterface $endDate): int
    {
        $startNumber = (int) $startDate->format('N');
        $endNumber = (int) $endDate->format('N');
        $daysBetweenStartAndEnd = $endDate->diff($startDate)->d;

        $weekendDays = (int) (2 * ($daysBetweenStartAndEnd + $startNumber) / 7);
        $weekendDays = $weekendDays - (7 == $startNumber ? 1 : 0) - (7 == $endNumber ? 1 : 0);

        return $weekendDays;
    }
}
