<?php

namespace App\Controller;

use App\Entity\Presence;
use App\Entity\PresenceModel;
use App\Form\PresenceType;
use App\Repository\DepartementRepository;
use App\Repository\EmployeRepository;
use App\Repository\PresenceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
     * @Route("/recap", name="presence_recap", methods={"GET"})
     */
    public function recapitulatifPresence(Request $request, PaginatorInterface $paginator, PresenceRepository $presenceRepository, EmployeRepository $employeRepository)
    {
        $presenceModelList = [];
        $options2 = [
            '2020' => '20',
            '2021' => '21',
        ];
        $options = [
            'Janvier' => '1',
            'Fevrier' => '2',
            'Mars' => '3',
            'Avril' => '4',
            'Mai' => '5',
            'Juin' => '6',
            'Juillet' => '7',
            'Aout' => '8',
            'Septembre' => '9',
            'Octobre' => '10',
            'Novembre' => '11', 'Decembre' => '12',
        ];
        $form = $this->createFormBuilder()
            ->add('month', ChoiceType::class, [
                'choices' => $options,
                'attr' => ['class' => 'selectpicker', 'data-size' => 5, 'data-live-search' => true],
            ])
            ->add('year', ChoiceType::class, [
                'choices' => $options2,
                'attr' => ['class' => 'selectpicker', 'data-size' => 5, 'data-live-search' => true],
            ])
            ->getForm();
        $form->handleRequest($request);
        //dump($form);
        $testday = new \DateTime();

        dump($request->request->get('form')['month']);
        dump($request->request->get('form')['year']);
        //dump($request->request->get('month'));
        if (null == $request->request->get('form')['month']) {
            //$date = \DateTime::createFromFormat('Y-m-d', date_format(new \DateTime(), 'y-m-d'));
            $date = date_format(new \DateTime(), 'y-m-d');
            $day = date('d', strtotime($date));
            $month = date('m', strtotime($date));
            $year = date('y', strtotime($date));
        /*$newdate = $testday->setDate($year,$month,$day);
        $newdateformat = date_diff($newdate, new \DateTime());*/
        } else {
            //$date = date_format(new \DateTime(), 'y-m-d');
            // $day = date('d', strtotime($date));
            $month = $request->request->get('form')['month'];
            $year = $request->request->get('form')['year'];
            /* $newdate = $testday->setDate($year,$month,$day);
             $newdateformat = date_diff($newdate, new \DateTime());*/
        }

        foreach ($employeRepository->findAll() as $employe) {
            $presenceModel = new PresenceModel();
            for ($i = 1; $i <= 31; ++$i) {
                $presence = $presenceRepository->findOneBy(['employe' => $employe, 'day' => $i, 'month' => $month, 'year' => $year]);
                $newdate = $testday->setDate($year, $month, $i);
                $newdateformat0 = date_format(new \DateTime(), 'y-m-d');
                $newdateformat1 = date_format($newdate, 'y-m-d');
                $newday = (int) date('d', strtotime($newdateformat0));
                $newday1 = (int) date('d', strtotime($newdateformat1));
                $newdateformat = date_diff($newdate, new \DateTime());
                /** numero du jour*/
                $numeroday = (int) $testday->format('N');
              if (6 == $numeroday) {
                    $presenceModel->setColor('gray');
                } elseif (7 == $numeroday) {
                    $presenceModel->setColor('darkgray');
                } else {
                    $presenceModel->setColor('blue');
                }
           /*     switch ($numeroday){
                    case 7:
                        $presenceModel->setColor('darkgray');
                        break;
                    case 6:
                        $presenceModel->setColor('gray');
                        break;
                    case 5:
                        if ($presence) {
                            $presenceModel->setStatus('present');
                            $presenceModel->setColor('bleu');
                        } else {
                            if ($newdateformat0 <= $newdateformat1) {
                                $presenceModel->setStatus('encours');
                            } else {
                                $presenceModel->setStatus('absent');
                            }
                        }
                        $presenceModel->setColor('blue');
                        break;
                    case 4:
                        if ($presence) {
                            $presenceModel->setStatus('present');
                            $presenceModel->setColor('bleu');
                        } else {
                            if ($newdateformat0 <= $newdateformat1) {
                                $presenceModel->setStatus('encours');
                            } else {
                                $presenceModel->setStatus('absent');
                            }
                        }
                        $presenceModel->setColor('blue');
                        break;
                    case 3:
                        if ($presence) {
                            $presenceModel->setStatus('present');
                            $presenceModel->setColor('bleu');
                        } else {
                            if ($newdateformat0 <= $newdateformat1) {
                                $presenceModel->setStatus('encours');
                            } else {
                                $presenceModel->setStatus('absent');
                            }
                        }
                        $presenceModel->setColor('blue');
                        break;
                    case 2:
                        if ($presence) {
                            $presenceModel->setStatus('present');
                            $presenceModel->setColor('bleu');
                        } else {
                            if ($newdateformat0 <= $newdateformat1) {
                                $presenceModel->setStatus('encours');
                            } else {
                                $presenceModel->setStatus('absent');
                            }
                        }
                        $presenceModel->setColor('blue');
                        break;
                    case 1:
                        if ($presence) {
                            $presenceModel->setStatus('present');
                            $presenceModel->setColor('bleu');
                        } else {
                            if ($newdateformat0 <= $newdateformat1) {
                                $presenceModel->setStatus('encours');
                            } else {
                                $presenceModel->setStatus('absent');
                            }
                        }
                        $presenceModel->setColor('blue');
                        break;
                    case 0:
                        if ($presence) {
                            $presenceModel->setStatus('present');
                            $presenceModel->setColor('bleu');
                        } else {
                            if ($newdateformat0 <= $newdateformat1) {
                                $presenceModel->setStatus('encours');
                            } else {
                                $presenceModel->setStatus('absent');
                            }
                        }
                        $presenceModel->setColor('blue');
                        break;
                }*/


                if ($presence) {
                    $presenceModel->setStatus('present');
                    $presenceModel->setColor('bleu');
                } else {
                    if ($newdateformat0 <= $newdateformat1) {
                        $presenceModel->setStatus('encours');
                    } else {
                        $presenceModel->setStatus('absent');
                    }
                }
                if (6 == $numeroday) {
                    $presenceModel->setColor('gray');
                    $presenceModel->setStatus('');
                } elseif (7 == $numeroday) {
                    $presenceModel->setColor('darkgray');
                    $presenceModel->setStatus('');
                } else {
                    //$presenceModel->setColor('blue');
                }
                $presenceModel->setDay($i);
            }

            //$presenceModel->setDay($presence->getDay());
            $presenceModel->setMonth($month);
            $presenceModel->setYear($year);
            $presenceModel->setEmploye($employe);
            $presenceModelList[] = $presenceModel;
        }
        $pagination = $paginator->paginate($presenceModelList, $request->query->getInt('page', 1), 12);

        return $this->render('presence/recapitulatif.html.twig', [
            'presences' => $pagination,
            'form' => $form->createView(),
            'test' => $testday,
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
            $date = date_format($jour, 'y-m-d');
            $presence->setDay(date('d', strtotime($date)));
            $presence->setMonth(date('m', strtotime($date)));
            $presence->setYear(date('y', strtotime($date)));
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
            'presences' => $presenceRepository->findByDepartement($departementRepository->find(1)),
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
