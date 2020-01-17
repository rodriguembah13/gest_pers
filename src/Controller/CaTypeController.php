<?php

namespace App\Controller;

use App\Entity\CaType;
use App\Form\CaTypeType;
use App\Repository\CaTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ca/type")
 */
class CaTypeController extends AbstractController
{
    /**
     * @Route("/", name="ca_type_index", methods={"GET"})
     */
    public function index(CaTypeRepository $caTypeRepository): Response
    {
        return $this->render('ca_type/index.html.twig', [
            'ca_types' => $caTypeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ca_type_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $caType = new CaType();
        $form = $this->createForm(CaTypeType::class, $caType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($caType);
            $entityManager->flush();

            return $this->redirectToRoute('ca_type_index');
        }

        return $this->render('ca_type/new.html.twig', [
            'ca_type' => $caType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ca_type_show", methods={"GET"})
     */
    public function show(CaType $caType): Response
    {
        return $this->render('ca_type/show.html.twig', [
            'ca_type' => $caType,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ca_type_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CaType $caType): Response
    {
        $form = $this->createForm(CaTypeType::class, $caType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ca_type_index');
        }

        return $this->render('ca_type/edit.html.twig', [
            'ca_type' => $caType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ca_type_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CaType $caType): Response
    {
        if ($this->isCsrfTokenValid('delete'.$caType->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($caType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ca_type_index');
    }
}
