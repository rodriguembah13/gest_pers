<?php

namespace App\Controller;

use App\Entity\Rhlignereglestructure;
use App\Form\RhlignereglestructureType;
use App\Repository\RhlignereglestructureRepository;
use App\Repository\RhreglesalaireRepository;
use App\Repository\RhstructuresalaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/rhlignereglestructure")
 */
class RhlignereglestructureController extends AbstractController
{
    /**
     * @Route("/", name="rhlignereglestructure_index", methods={"GET"})
     */
    public function index(RhlignereglestructureRepository $rhlignereglestructureRepository): Response
    {
        return $this->render('rhlignereglestructure/index.html.twig', [
            'rhlignereglestructures' => $rhlignereglestructureRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="rhlignereglestructure_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $rhlignereglestructure = new Rhlignereglestructure();
        $form = $this->createForm(RhlignereglestructureType::class, $rhlignereglestructure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($rhlignereglestructure);
            $entityManager->flush();

            return $this->redirectToRoute('rhlignereglestructure_index');
        }

        return $this->render('rhlignereglestructure/new.html.twig', [
            'rhlignereglestructure' => $rhlignereglestructure,
            'form' => $form->createView(),
        ]);
    }

    public function postJsonStructureLine(Request $request, RhreglesalaireRepository $rhreglesalaireRepository, RhstructuresalaireRepository $rhstructuresalaireRepository): JsonResponse
    {
        $linestructureregle = new Rhlignereglestructure();
        $structure = $rhstructuresalaireRepository->find($request->query->get('id_structure'));
        $regle = $rhreglesalaireRepository->find($request->query->get('id_regle'));
        $linestructureregle->setRhreglesalaire($regle);
        $linestructureregle->setRhstructuresalaire($structure);
        $linestructureregle->setLibelle($regle->getLibelle().$structure->getLibelle());
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($linestructureregle);
        $entityManager->flush();
        $responseArray[] = [
            'id' => $linestructureregle->getId(),
            'libelle' => $linestructureregle->getLibelle(),
        ];

        return new JsonResponse($responseArray);
    }

    /**
     * @Route("/edit/rest/", name="rhlignereglestructure_edit_rest", methods={"GET"})
     */
    public function postEditJsonStructureLine(Request $request, RhreglesalaireRepository $rhreglesalaireRepository, RhstructuresalaireRepository $rhstructuresalaireRepository): JsonResponse
    {
        $linestructureregle = new Rhlignereglestructure();
        $structure = $rhstructuresalaireRepository->find($request->query->get('id_structure'));
        $regle = $rhreglesalaireRepository->find($request->query->get('id_regle'));
        $linestructureregle->setRhreglesalaire($regle);
        $linestructureregle->setRhstructuresalaire($structure);
        $linestructureregle->setLibelle($regle->getLibelle().$structure->getLibelle());
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($linestructureregle);
        $entityManager->flush();
        $responseArray[] = [
            'id' => $linestructureregle->getId(),
            'libelle' => $linestructureregle->getLibelle(),
        ];

        return new JsonResponse($responseArray);
    }

    /**
     * @Route("/delete/rest/", name="rhlignereglestructure_delete_rest", methods={"GET"})
     */
    public function deleteJsonStructureLine(Request $request, RhlignereglestructureRepository $repository, RhstructuresalaireRepository $rhstructuresalaireRepository): JsonResponse
    {
        //$structure = $rhstructuresalaireRepository->find($request->query->get('id_structure'));
        $linestructureregle = $repository->find($request->query->get('id_line'));
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($linestructureregle);
        $entityManager->flush();
        /*$responseArray[] = [
            'id' => $linestructureregle->getId(),
            'libelle' => $linestructureregle->getLibelle(),
        ];*/

        return new JsonResponse('ok',200);
    }

    /**
     * @Route("/{id}", name="rhlignereglestructure_show", methods={"GET"})
     */
    public function show(Rhlignereglestructure $rhlignereglestructure): Response
    {
        return $this->render('rhlignereglestructure/show.html.twig', [
            'rhlignereglestructure' => $rhlignereglestructure,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="rhlignereglestructure_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Rhlignereglestructure $rhlignereglestructure): Response
    {
        $form = $this->createForm(RhlignereglestructureType::class, $rhlignereglestructure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('rhlignereglestructure_index');
        }

        return $this->render('rhlignereglestructure/edit.html.twig', [
            'rhlignereglestructure' => $rhlignereglestructure,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="rhlignereglestructure_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Rhlignereglestructure $rhlignereglestructure): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rhlignereglestructure->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($rhlignereglestructure);
            $entityManager->flush();
        }

        return $this->redirectToRoute('rhlignereglestructure_index');
    }
}
