<?php

namespace App\Controller;

use App\Entity\Presence;
use App\Form\PresenceType;
use App\Repository\DepartementRepository;
use App\Repository\EmployeRepository;
use App\Repository\PresenceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/presence")
 */
class PresenceController extends AbstractController
{
    /**
     * @Route("/", name="presence_index", methods={"GET"})
     */
    public function index(PresenceRepository $presenceRepository, PaginatorInterface $paginator, Request $request, EntityManagerInterface $em): Response
    {
        $dql = 'SELECT a FROM App\Entity\Presence a';
        $query = $em->createQuery($dql);
        $pagination = $paginator->paginate($query, $request->query->getInt('page', 1), 12);

        return $this->render('presence/index.html.twig', [
            'presences' => $pagination,
        ]);
    }

    /**
     * Returns a JSON string with the neighborhoods of the City with the providen id.
     */
    public function listsemploye(Request $request, EmployeRepository $employeRepository): JsonResponse
    {
        // Get Entity manager and repository
        $em = $this->getDoctrine()->getManager();
        // $neighborhoodsRepository = $em->getRepository('AppBundle:Neighborhood');

        // Search the neighborhoods that belongs to the city with the given id as GET parameter "cityid"
        $employes = $employeRepository->createQueryBuilder('q')
            ->where('q.departement = :departementid')
            ->setParameter('departementid', $request->query->get('departement_id'))
            ->getQuery()
            ->getResult();

        // Serialize into an array the data that we need, in this case only name and id
        // Note: you can use a serializer as well, for explanation purposes, we'll do it manually
        $responseArray = [];
        foreach ($employes as $employe) {
            $responseArray[] = [
                'id' => $employe->getId(),
                'nomComplet' => $employe->getNomComplet(),
                'matricule' => $employe->getNomComplet(),
                'poste' => $employe->getPoste()->getLibelle(),
            ];
        }

        return new JsonResponse($responseArray);
    }

    /**
     * Returns a JSON string with the neighborhoods of the City with the providen id.
     */
    public function listspresence(Request $request, PresenceRepository $presenceRepository): JsonResponse
    {
        // Get Entity manager and repository
        $em = $this->getDoctrine()->getManager();
        $presences = $presenceRepository->findByDepartementAndJour($request->query->get('departement_id'), $request->query->get('jour'));
        $responseArray = [];
        $heureDepart = '';
        foreach ($presences as $presence) {
            if (null == $presence->getHeureDepart()) {
                $heureDepart = '';
            } else {
                $heureDepart = $presence->getHeureDepart()->format('H:i:s');
            }
            $responseArray[] = [
                'id' => $presence->getId(),
                'nomComplet' => $presence->getEmploye()->getNomComplet(),
                'heureArrivee' => $presence->getHeureArrivee()->format('H:i:s'),

                'heureDepart' => $heureDepart,
                'dateCreation' => $presence->getDateCreation()->format('Y-m-d'),
            ];
        }

        return new JsonResponse($responseArray);
    }

    /**
     * Returns a JSON string with the neighborhoods of the City with the providen id.
     */
    public function postrest(Request $request, EmployeRepository $employeRepository, PresenceRepository $presenceRepository): JsonResponse
    {
        // Get Entity manager and repository
        $entityManager = $this->getDoctrine()->getManager();

        $tatus = $request->query->get('status');
        if ('start' === $tatus) {
            $employe = $employeRepository->find($request->query->get('id_employe'));
            $jour = \DateTime::createFromFormat('Y-m-d', $request->query->get('jour'));
            $presence_stat = $presenceRepository->findOneBy(['employe' => $employe, 'dateCreation' => $jour]);
            if (null != $presence_stat) {
                $presence = $presence_stat;
            } else {
                $presence = new Presence();
            }

            $newformat = date($request->query->get('heureArrivee'));
            $newforma = date('Y-m-d H:i:s', strtotime($newformat));
            $presence->setHeureArrivee(\DateTime::createFromFormat('Y-m-d H:i:s', $newforma));
            // $presence->setHeureDepart(null);
            $presence->setDateCreation(\DateTime::createFromFormat('Y-m-d', $request->query->get('jour')));
            $presence->setEmploye($employe);
            $entityManager->persist($presence);
        } elseif ('stop' === $tatus) {
            $newformat = date($request->query->get('heureDepart'));
            $newforma = date('Y-m-d H:i:s', strtotime($newformat));
            $presence = $presenceRepository->find($request->query->get('id_presence'));
            $presence->setHeureDepart(\DateTime::createFromFormat('Y-m-d H:i:s', $newforma));
            $entityManager->persist($presence);
        }

        $entityManager->flush();
        $responseArray[] = [
            'presence' => $presence->getHeureArrivee(),
        ];

        return new JsonResponse($responseArray);
    }

    /**
     * @Route("/interface", name="presence_interface", methods={"GET"})
     */
    public function interface(PresenceRepository $presenceRepository, DepartementRepository $departementRepository): Response
    {
        $presence = new Presence();
        $formBuilder = $this->createFormBuilder($presence);
        $formBuilder2 = $this->createFormBuilder($presence);
        $formBuilder
            ->add('heureArrivee', TimeType::class, [
                'widget' => 'single_text',
                'required' => false,
                'empty_data' => '',
            ]);
        $form = $formBuilder->getForm();
        $formBuilder2
            ->add('heureDepart', TimeType::class, [
                'widget' => 'single_text',
                'required' => false,
                'empty_data' => '',
            ]);
        $form2 = $formBuilder2->getForm();
        // $departement=handleRequest($request);
        return $this->render('presence/interface.html.twig', [
            'departements' => $departementRepository->findAll(),
            'presences' => $presenceRepository->findByDepartement($departementRepository->find(102)),
            'form' => $form->createView(),
            'form2' => $form2->createView(),
        ]);
    }

    /**
     * @Route("/new", name="presence_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $presence = new Presence();
        $form = $this->createForm(PresenceType::class, $presence);
        $form->handleRequest($request);
        dump($form);
        /*if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($presence);
            $entityManager->flush();

            return $this->redirectToRoute('presence_index');
        }*/

        return $this->render('presence/new.html.twig', [
            'presence' => $presence,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="presence_show", methods={"GET"})
     */
    public function show(Presence $presence): Response
    {
        return $this->render('presence/show.html.twig', [
            'presence' => $presence,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="presence_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Presence $presence): Response
    {
        $form = $this->createForm(PresenceType::class, $presence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('presence_index');
        }

        return $this->render('presence/edit.html.twig', [
            'presence' => $presence,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="presence_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Presence $presence): Response
    {
        if ($this->isCsrfTokenValid('delete'.$presence->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($presence);
            $entityManager->flush();
        }

        return $this->redirectToRoute('presence_index');
    }
}
