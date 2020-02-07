<?php

namespace App\Controller;

use App\Entity\Poste;
use App\Form\PosteType;
use App\Repository\PosteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/poste")
 */
class PosteController extends AbstractController
{
    /**
     * @Route("/", name="poste_index", methods={"GET"})
     */
    public function index(PosteRepository $posteRepository,PaginatorInterface $paginator, Request $request,EntityManagerInterface $em): Response
    {$dql = 'SELECT a FROM App\Entity\Poste a';
        $query = $em->createQuery($dql);
        $pagination = $paginator->paginate($query, $request->query->getInt('page', 1), 12);
        return $this->render('poste/index.html.twig', [
            'postes' => $pagination,
        ]);
    }

    /**
     * @Route("/new", name="poste_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $poste = new Poste();
        $form = $this->createForm(PosteType::class, $poste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($poste);
            $entityManager->flush();

            return $this->redirectToRoute('poste_index');
        }

        return $this->render('poste/new.html.twig', [
            'poste' => $poste,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="poste_show", methods={"GET"})
     */
    public function show(Poste $poste): Response
    {
        return $this->render('poste/show.html.twig', [
            'poste' => $poste,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="poste_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Poste $poste): Response
    {
        $form = $this->createForm(PosteType::class, $poste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('poste_index');
        }

        return $this->render('poste/edit.html.twig', [
            'poste' => $poste,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="poste_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Poste $poste): Response
    {
        if ($this->isCsrfTokenValid('delete'.$poste->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($poste);
            $entityManager->flush();
        }

        return $this->redirectToRoute('poste_index');
    }
}
