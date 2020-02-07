<?php

namespace App\Controller;

use App\Entity\Rhstructuresalaire;
use App\Form\RhstructuresalaireType;
use App\Repository\RhreglesalaireRepository;
use App\Repository\RhstructuresalaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/rhstructuresalaire")
 */
class RhstructuresalaireController extends AbstractController
{
    /**
     * @Route("/", name="rhstructuresalaire_index", methods={"GET"})
     */
    public function index(RhstructuresalaireRepository $rhstructuresalaireRepository, PaginatorInterface $paginator, Request $request, EntityManagerInterface $em): Response
    {
        $dql = 'SELECT a FROM App\Entity\Rhstructuresalaire a';
        $query = $em->createQuery($dql);
        $pagination = $paginator->paginate($query, $request->query->getInt('page', 1), 12);

        return $this->render('rhstructuresalaire/index.html.twig', [
            'rhstructuresalaires' => $pagination,
        ]);
    }

    /**
     * @Route("/new", name="rhstructuresalaire_new", methods={"GET","POST"})
     */
    public function new(Request $request, RhreglesalaireRepository $rhreglesalaireRepository): Response
    {
        $rhstructuresalaire = new Rhstructuresalaire();
        $form = $this->createForm(RhstructuresalaireType::class, $rhstructuresalaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($rhstructuresalaire);
            $entityManager->flush();

            return $this->redirectToRoute('rhstructuresalaire_index');
        }

        return $this->render('rhstructuresalaire/new.html.twig', [
            'rhstructuresalaire' => $rhstructuresalaire,
            'form' => $form->createView(),
            'rhreglesalaires' => $rhreglesalaireRepository->findAll(),
        ]);
    }

    public function postJsonStructure(Request $request): JsonResponse
    {
        $structure = new Rhstructuresalaire();
        $structure->setReference($request->query->get('reference'));
        $structure->setLibelle($request->query->get('libelle'));
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($structure);
        $entityManager->flush();
        $responseArray[] = [
            'id' => $structure->getId(),
            'libelle' => $structure->getLibelle(),
            'reference' => $structure->getReference(),
        ];

        return new JsonResponse($responseArray);
    }

    public function postEditJsonStructure(Request $request): JsonResponse
    {
        $structure = new Rhstructuresalaire();
        $structure->setReference($request->query->get('reference'));
        $structure->setLibelle($request->query->get('libelle'));
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($structure);
        $entityManager->flush();
        $responseArray[] = [
            'id' => $structure->getId(),
            'libelle' => $structure->getLibelle(),
            'reference' => $structure->getReference(),
        ];

        return new JsonResponse($responseArray);
    }

    /**
     * @Route("/{id}", name="rhstructuresalaire_show", methods={"GET"})
     */
    public function show(Rhstructuresalaire $rhstructuresalaire): Response
    {
        return $this->render('rhstructuresalaire/show.html.twig', [
            'rhstructuresalaire' => $rhstructuresalaire,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="rhstructuresalaire_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Rhstructuresalaire $rhstructuresalaire, RhreglesalaireRepository $rhreglesalaireRepository): Response
    {
        $form = $this->createForm(RhstructuresalaireType::class, $rhstructuresalaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('rhstructuresalaire_index');
        }

        return $this->render('rhstructuresalaire/edit.html.twig', [
            'rhstructuresalaire' => $rhstructuresalaire,
            'form' => $form->createView(),
            'rhreglesalaires' => $rhreglesalaireRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="rhstructuresalaire_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Rhstructuresalaire $rhstructuresalaire): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rhstructuresalaire->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            foreach ($rhstructuresalaire->getRhlignereglestructures() as $line) {
                $entityManager->remove($line);
            }
            $entityManager->remove($rhstructuresalaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('rhstructuresalaire_index');
    }
}
