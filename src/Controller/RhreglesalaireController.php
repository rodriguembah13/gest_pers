<?php

namespace App\Controller;

use App\Entity\Rhreglesalaire;
use App\Form\RhreglesalaireType;
use App\Repository\RhreglesalaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/rhreglesalaire")
 */
class RhreglesalaireController extends AbstractController
{
    /**
     * @Route("/", name="rhreglesalaire_index", methods={"GET"})
     */
    public function index(RhreglesalaireRepository $rhreglesalaireRepository,PaginatorInterface $paginator, Request $request,EntityManagerInterface $em): Response
    {
        $dql = 'SELECT a FROM App\Entity\Rhreglesalaire a';
        $query = $em->createQuery($dql);
        $pagination = $paginator->paginate($query, $request->query->getInt('page', 1), 12);
        return $this->render('rhreglesalaire/index.html.twig', [
            'rhreglesalaires' => $pagination,
        ]);
    }

    /**
     * @Route("/new", name="rhreglesalaire_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $rhreglesalaire = new Rhreglesalaire();
        $form = $this->createForm(RhreglesalaireType::class, $rhreglesalaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($rhreglesalaire);
            $entityManager->flush();

            return $this->redirectToRoute('rhreglesalaire_index');
        }

        return $this->render('rhreglesalaire/new.html.twig', [
            'rhreglesalaire' => $rhreglesalaire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="rhreglesalaire_show", methods={"GET"})
     */
    public function show(Rhreglesalaire $rhreglesalaire): Response
    {
        return $this->render('rhreglesalaire/show.html.twig', [
            'rhreglesalaire' => $rhreglesalaire,
        ]);
    }

    public function getJsonRegle(Request $request, RhreglesalaireRepository $rhreglesalaireRepository): JsonResponse
    {
        $rhreglesalaire = $rhreglesalaireRepository->find($request->query->get('regle_id'));
        $responseArray[] = [
            'id' => $rhreglesalaire->getId(),
            'libelle' => $rhreglesalaire->getLibelle(),
            'code' => $rhreglesalaire->getCode(),
        ];

        return new JsonResponse($responseArray);
    }

    /**
     * @Route("/{id}/edit", name="rhreglesalaire_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Rhreglesalaire $rhreglesalaire): Response
    {
        $form = $this->createForm(RhreglesalaireType::class, $rhreglesalaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('rhreglesalaire_index');
        }

        return $this->render('rhreglesalaire/edit.html.twig', [
            'rhreglesalaire' => $rhreglesalaire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="rhreglesalaire_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Rhreglesalaire $rhreglesalaire): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rhreglesalaire->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($rhreglesalaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('rhreglesalaire_index');
    }
}
