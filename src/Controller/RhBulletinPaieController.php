<?php

namespace App\Controller;

use App\Entity\RhBulletinPaie;
use App\Entity\Rhlignereglepaie;
use App\Entity\Rhreglesalaire;
use App\Form\RhBulletinPaieType;
use App\Repository\AdvanceSalaireRepository;
use App\Repository\HolidayRepository;
use App\Repository\RhBulletinPaieRepository;
use App\Repository\RhlignereglepaieRepository;
use App\Repository\RhreglesalaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/rh/bulletin/paie")
 */
class RhBulletinPaieController extends AbstractController
{
    /**
     * @Route("/", name="rh_bulletin_paie_index", methods={"GET"})
     */
    public function index(RhBulletinPaieRepository $rhBulletinPaieRepository, PaginatorInterface $paginator, Request $request, EntityManagerInterface $em): Response
    {
        $dql = 'SELECT a FROM App\Entity\RhBulletinPaie a';
        $query = $em->createQuery($dql);
        $pagination = $paginator->paginate($query, $request->query->getInt('page', 1), 12);

        return $this->render('rh_bulletin_paie/index.html.twig', [
            'rh_bulletin_paies' => $pagination,
        ]);
    }

    /**
     * @Route("/new", name="rh_bulletin_paie_new", methods={"GET","POST"})
     */
    public function new(Request $request, RhreglesalaireRepository $rhreglesalaireRepository, RhlignereglepaieRepository $rhlignereglepaieRepository): Response
    {
        $rhBulletinPaie = new RhBulletinPaie();
        $form = $this->createForm(RhBulletinPaieType::class, $rhBulletinPaie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $rhBulletinPaie->setDatepaie(new \DateTime());
            $rhBulletinPaie->setDatecreation(new \DateTime());
            if (null == $rhBulletinPaie->getEtat()) {
                $rhBulletinPaie->setEtat('encours');
            }

            $entityManager->persist($rhBulletinPaie);

            foreach ($rhBulletinPaie->getRhstructurepaie()->getRhlignereglestructures() as $regle) {
                $rhligne = new Rhlignereglepaie();
                $rhligne->setLibelle($regle->getLibelle().'-'.'bulletin');
                $rhligne->setRhreglesalaire($regle->getRhreglesalaire());
                if (null === $regle->getRhreglesalaire()->getQuantite()) {
                    $rhligne->setQuantite(1);
                } else {
                    $rhligne->setQuantite($regle->getRhreglesalaire()->getQuantite());
                }

                $rhligne->setRhBulletinPaie($rhBulletinPaie);
                $entityManager->persist($rhligne);
                $rhBulletinPaie->addRhlignereglepaie($rhligne);
            }
            $entityManager->persist($rhBulletinPaie);
            $entityManager->flush();
            $this->createLineBaseIRRP($rhBulletinPaie, $rhreglesalaireRepository, $rhlignereglepaieRepository);
            $this->createLineRegleRCE($rhBulletinPaie, $rhreglesalaireRepository, $rhlignereglepaieRepository);
            $url = $this->generateUrl('rh_bulletin_paie_edit', ['id' => $rhBulletinPaie->getId()]);

            return $this->redirect($url);
        }

        return $this->render('rh_bulletin_paie/new.html.twig', [
            'rh_bulletin_paie' => $rhBulletinPaie,
            'form' => $form->createView(),
            'rhreglesalaires' => $rhreglesalaireRepository->findAll(),
        ]);
    }

    private function calcul(Rhlignereglepaie $rhlignereglepaie, RhlignereglepaieRepository $repository, AdvanceSalaireRepository $advanceSalaireRepository)
    {
        // $rhlignereglepaie->setTotal(0);
        if ('expression' === $rhlignereglepaie->getRhreglesalaire()->getRhcondition()) {
            if ('montant' === $rhlignereglepaie->getRhreglesalaire()->getTypecondition()) {
                $codecalcul = $rhlignereglepaie->getRhreglesalaire()->getCodecalcul();
            } elseif ('pourcentage' === $rhlignereglepaie->getRhreglesalaire()->getTypecondition()) {
                $codecalcul = $rhlignereglepaie->getRhreglesalaire()->getCodecalcul();
            } elseif ('expression' === $rhlignereglepaie->getRhreglesalaire()->getTypecondition()) {
                $codecalcul = $rhlignereglepaie->getRhreglesalaire()->getCodecalcul();
                $array_string = explode('+', $codecalcul);
                $arraystring1 = explode('.', $array_string[0]);
                if ('cat' === $arraystring1[0]) {
                } elseif ('contrat' == $arraystring1[0]) {
                    $montant = $rhlignereglepaie->getRhBulletinPaie()->getRhcontrat()->getSalaire();
                    $quantite = $rhlignereglepaie->getRhreglesalaire()->getQuantite();
                    $rhlignereglepaie->setQuantite($quantite);
                    $rhlignereglepaie->setTotal($montant * $quantite);
                }
            }
        } elseif ('plage' === $rhlignereglepaie->getRhreglesalaire()->getRhcondition()) {
            $plagemin = $rhlignereglepaie->getRhreglesalaire()->getPlagemin();
            $plagemax = $rhlignereglepaie->getRhreglesalaire()->getPlagemax();
            $plagesur = $rhlignereglepaie->getRhreglesalaire()->getPlagesur();
            if ('montant' === $rhlignereglepaie->getRhreglesalaire()->getTypecondition()) {
                $codecalcul = $rhlignereglepaie->getRhreglesalaire()->getCodecalcul();
            } elseif ('pourcentage' === $rhlignereglepaie->getRhreglesalaire()->getTypecondition()) {
                $pourcentagesur = $rhlignereglepaie->getRhreglesalaire()->getPourcentagesur();
                $pourcentage = $rhlignereglepaie->getRhreglesalaire()->getPourcentage();
                if ('contrat' == '$arraystring1[0]') {
                    $montant = $rhlignereglepaie->getRhBulletinPaie()->getRhcontrat()->getSalaire();
                    $quantite = $rhlignereglepaie->getRhreglesalaire()->getQuantite();
                    $rhlignereglepaie->setQuantite(1);
                    $rhlignereglepaie->setTotal($montant * 1);
                    //}
                }
                $codecalcul = $rhlignereglepaie->getRhreglesalaire()->getCodecalcul();
            } elseif ('expression' === $rhlignereglepaie->getRhreglesalaire()->getTypecondition()) {
                $codecalcul = $rhlignereglepaie->getRhreglesalaire()->getCodecalcul();
            }
        } elseif ('toujours' == $rhlignereglepaie->getRhreglesalaire()->getRhcondition()) {
            if ('montant' == $rhlignereglepaie->getRhreglesalaire()->getTypecondition()) {
                $montant = $rhlignereglepaie->getRhreglesalaire()->getMontantfixe();
                $quantite = $rhlignereglepaie->getRhreglesalaire()->getQuantite();
                $rhlignereglepaie->setQuantite($quantite);
                $rhlignereglepaie->setTotal($montant * $quantite);
            } elseif ('pourcentage' == $rhlignereglepaie->getRhreglesalaire()->getTypecondition()) {
                $pourcentagesur = $rhlignereglepaie->getRhreglesalaire()->getPourcentagesur();
                if ('contrat' == $pourcentagesur) {
                    $montant = $rhlignereglepaie->getRhBulletinPaie()->getRhcontrat()->getSalaire();
                }
                $pourcentage = $rhlignereglepaie->getRhreglesalaire()->getPourcentage();
                $quantite = $rhlignereglepaie->getRhreglesalaire()->getQuantite();
                $rhlignereglepaie->setTotal($quantite * ($montant * $pourcentage) / 100);
            } elseif ('expression' === $rhlignereglepaie->getRhreglesalaire()->getTypecondition()) {
                $codecalcul = $rhlignereglepaie->getRhreglesalaire()->getCodecalcul();
                $array_string = explode('+', $codecalcul);
                $arraystring1 = explode('.', $array_string[0]);
                if (sizeof(explode('+', $codecalcul)) > 1) {
                    //if ('BASIC' !== $rhlignereglepaie->getRhreglesalaire()->getRhcategorieregle()->getCode()) {
                    $array_string_ex = explode('+', $codecalcul);
                    $mtn = 0;
                    foreach ($array_string_ex as $separateur) {
                        $cat = explode('.', $separateur);
                        if ('cat' === $cat[0]) {
                            $lineregles = $repository->findByBulletinorderByCat($rhlignereglepaie->getRhBulletinPaie(), $cat[1]);
                        } elseif ('regle' === $cat[0]) {
                            $lineregles = $repository->findByBulletinorderByCategorieRegle($rhlignereglepaie->getRhBulletinPaie(), $cat[1]);
                        }
                        foreach ($lineregles as $line) {
                            if ('allocation' === $line->getRhreglesalaire()->getRhcategorieregle()->getOperation()) {
                                $mtn += $line->getTotal();
                            } elseif ('allocation-net' === $line->getRhreglesalaire()->getRhcategorieregle()->getOperation()) {
                                $mtn += $line->getTotal();
                            } elseif ('deduction' === $line->getRhreglesalaire()->getRhcategorieregle()->getOperation()) {
                                $mtn -= $line->getTotal();
                            } elseif ('deduction-net' === $line->getRhreglesalaire()->getRhcategorieregle()->getOperation()) {
                                $mtn -= $line->getTotal();
                            } elseif ('basic' === $line->getRhreglesalaire()->getRhcategorieregle()->getOperation()) {
                                $mtn += $line->getTotal();
                            } else {
                                //$mtn += $line->getTotal();
                            }
                        }
                    }
                    // $rhlignereglepaie->setQuantite($quantite);
                    $rhlignereglepaie->setTotal($mtn);
                } else {
                    if ('contrat' == $arraystring1[0]) {
                        $montant = $rhlignereglepaie->getRhBulletinPaie()->getRhcontrat()->getSalaire();
                        $quantite = $rhlignereglepaie->getRhreglesalaire()->getQuantite();
                        $rhlignereglepaie->setQuantite(1);
                        $rhlignereglepaie->setTotal($montant * 1);
                    //}
                    } elseif ('refund' == $arraystring1[0]) {
                        $montant = $this->calculRemboursement($rhlignereglepaie, $advanceSalaireRepository);
                        $quantite = $rhlignereglepaie->getRhreglesalaire()->getQuantite();
                        $rhlignereglepaie->setQuantite(1);
                        //$rhlignereglepaie->setTotal($montant * 1);
                    }
                }
            }
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($rhlignereglepaie);

        return $rhlignereglepaie;
    }

    public function calculRemboursement(Rhlignereglepaie $rhlignereglepaie, AdvanceSalaireRepository $advanceSalaireRepository): float
    {
        $entityManager = $this->getDoctrine()->getManager();
        //$montant = 0;
        $date_ = $rhlignereglepaie->getRhBulletinPaie()->getPeriodeDebut();
        $month = (int) date('m', strtotime($date_->format('y-m-d')));
        if (null == $advanceSalaireRepository->findBy(['employe' => $rhlignereglepaie->getRhBulletinPaie()->getEmploye(), 'status' => false])) {
            return 0.0;
        } else {
            $advance = $advanceSalaireRepository->findOneBy(['employe' => $rhlignereglepaie->getRhBulletinPaie()->getEmploye(), 'status' => false]);
            $advandeEcheances = $advance->getAdvanceSalaireEcheances();
            foreach ($advandeEcheances as $advandeEcheance) {
                $montant = 0.0;
                if (false == $advandeEcheance->getStatut() and $advandeEcheance->getMonth() == $month) {
                    $montant = $advandeEcheance->getMontant();
                    $rhlignereglepaie->setTotal($advandeEcheance->getMontant());
                    if (0 == $advance->getMontantRestant() - $montant) {
                        $advance->setMontantRestant($advance->getMontantRestant() - $montant);
                        $advance->setStatus(true);
                    } else {
                        $advance->setMontantRestant($advance->getMontantRestant() - $montant);
                    }
                    $advandeEcheance->setStatut(true);
                    $entityManager->persist($advance);
                    $entityManager->persist($advandeEcheance);
                }
            }
            $entityManager->flush();

            return $montant;
        }
    }

    private function getRegleRCE(Rhlignereglepaie $rhlignereglepaie, RhreglesalaireRepository $repository): Rhreglesalaire
    {
        $plagemin = $rhlignereglepaie->getRhreglesalaire()->getPlagemin();
        $plagemax = $rhlignereglepaie->getRhreglesalaire()->getPlagemax();
        $plagesur = $rhlignereglepaie->getRhreglesalaire()->getPlagesur();
        $regle = $repository->findOneBy(['rhcondition' => 'plage']);
    }

    private function createLineRegleRCE(RhBulletinPaie $bulletinPaie, RhreglesalaireRepository $repository, RhlignereglepaieRepository $rhlignereglepaieRepository)
    {
        $regle = $repository->findByOneFieldBetweenChild($bulletinPaie->getRhcontrat(), 'CHE');
        $entityManager = $this->getDoctrine()->getManager();
        $pourcentage = $regle->getPourcentage();
        $pourcentagesur = $regle->getPourcentagesur();
        $lignepourcentagesur = $rhlignereglepaieRepository->findOneByBulletinorderByCat($bulletinPaie, $pourcentagesur);

        $line = new Rhlignereglepaie();
        $line->setQuantite($regle->getQuantite());
        $line->setRhBulletinPaie($bulletinPaie);
        $line->setRhreglesalaire($regle);
        $line->setLibelle($regle->getLibelle().'-'.'bulletin');
        $line->setTotal($lignepourcentagesur->getTotal() * $pourcentage / 100);
        $entityManager->persist($line);
        $entityManager->flush();
    }

    private function createLineBaseIRRP(RhBulletinPaie $bulletinPaie, RhreglesalaireRepository $repository, RhlignereglepaieRepository $rhlignereglepaieRepository)
    {
        $regle = $repository->findByOneFieldBetwenSalaire($bulletinPaie->getRhcontrat(), 'birpp');
        $entityManager = $this->getDoctrine()->getManager();
        $pourcentage = $regle->getPourcentage();
        $pourcentagesur = $regle->getPourcentagesur();

        $line = new Rhlignereglepaie();
        $line->setQuantite($regle->getQuantite());
        $line->setRhBulletinPaie($bulletinPaie);
        $line->setRhreglesalaire($regle);
        $line->setLibelle($regle->getLibelle().'-'.'bulletin');
        /* foreach ($bulletinPaie->getRhlignereglepaies() as $ligne) {
             if ($ligne->getRhreglesalaire()->getCode() === $pourcentagesur) {
             }*/
        $line->setTotal($bulletinPaie->getRhcontrat()->getSalaire() * $pourcentage / 100);
        $entityManager->persist($line);
        $entityManager->flush();
    }

    /**
     * @Route("/{id}", name="rh_bulletin_paie_show", methods={"GET"})
     */
    public function show(RhBulletinPaie $rhBulletinPaie): Response
    {
        return $this->render('rh_bulletin_paie/show.html.twig', [
            'rh_bulletin_paie' => $rhBulletinPaie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="rh_bulletin_paie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, RhBulletinPaie $rhBulletinPaie, RhlignereglepaieRepository $repository, HolidayRepository $holidayRepository, AdvanceSalaireRepository $advanceSalaireRepository, RhreglesalaireRepository $rhreglesalaireRepository): Response
    {
        $form = $this->createForm(RhBulletinPaieType::class, $rhBulletinPaie);
        $form->handleRequest($request);
        $quantite = 0;
        $rhlignes = $repository->findByBulletinorderBySequence($rhBulletinPaie);

        $workday = $this->getDayWorkbetweenDate($rhBulletinPaie, $holidayRepository);
        // $rhlignes = $repository->findByBulletinorderByCat($rhBulletinPaie,'basic');
        //$arraystring = explode('+', 'cat');
        //$arraystring1 = explode('.', $arraystring[0]);
        if ($form->isSubmitted() && $form->isValid()) {
            //$entityManager = $this->getDoctrine()->getManager();

            foreach ($rhlignes as $ligne) {
                $rhligne = $this->calcul($ligne, $repository, $advanceSalaireRepository);
                $string = $ligne->getRhreglesalaire()->getCodecalcul();
                //$rhBulletinPaie->addRhlignereglepaie($rhligne);
            }
            $rhBulletinPaie->setEtat('confirmation');

            $this->getDoctrine()->getManager()->flush();
            $url = $this->generateUrl('rh_bulletin_paie_confirme', ['id' => $rhBulletinPaie->getId()]);

            return $this->redirect($url);
        }

        //$regle = $rhreglesalaireRepository->findByOneFieldBetwenSalaire($rhBulletinPaie->getRhcontrat(), 'birpp');
        return $this->render('rh_bulletin_paie/edit.html.twig', [
            'rh_bulletin_paie' => $rhBulletinPaie,
            'form' => $form->createView(),
            'rhlignereglepaies' => $rhlignes,
           // 'arrays' => $regle->getId(),
            'rhreglesalaires' => $rhreglesalaireRepository->findAll(),
            //'workday' => $workday,
        ]);
    }

    /**
     * @Route("/{id}/confirme", name="rh_bulletin_paie_confirme", methods={"GET","POST"})
     */
    public function confirmation(Request $request, RhBulletinPaie $rhBulletinPaie, RhlignereglepaieRepository $repository, AdvanceSalaireRepository $advanceSalaireRepository, RhreglesalaireRepository $rhreglesalaireRepository): Response
    {
        $form = $this->createForm(RhBulletinPaieType::class, $rhBulletinPaie);
        $form->handleRequest($request);
        $quantite = 0;
        $rhlignes = $repository->findByBulletinorderBySequence($rhBulletinPaie);
        foreach ($rhlignes as $ligne) {
            $rhligne = $this->calcul($ligne, $repository, $advanceSalaireRepository);
        }
        $rhBulletinPaie->setEtat('valide');
        $this->getDoctrine()->getManager()->flush();
        $regle = $rhreglesalaireRepository->findByOneFieldBetweenChild($rhBulletinPaie->getRhcontrat(), 'birpp');

        return $this->render('rh_bulletin_paie/edit.html.twig', [
            'rh_bulletin_paie' => $rhBulletinPaie,
            'form' => $form->createView(),
            'rhlignereglepaies' => $rhlignes,
            'arrays' => $regle,
        ]);
    }

    /**
     * @Route("/{id}", name="rh_bulletin_paie_delete", methods={"DELETE"})
     */
    public function delete(Request $request, RhBulletinPaie $rhBulletinPaie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rhBulletinPaie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            foreach ($rhBulletinPaie->getRhlignereglepaies() as $ligne) {
                $entityManager->remove($ligne);
            }
            $entityManager->remove($rhBulletinPaie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('rh_bulletin_paie_index');
    }

    private function getDayWorkbetweenDate(RhBulletinPaie $bulletinPaie, HolidayRepository $holidayRepository): int
    {
        $nbreweekend = $this->getNumberOfWeekendDays($bulletinPaie->getPeriodeDebut(), $bulletinPaie->getPeriodeFin());
        $holiday = $holidayRepository->findByBetweenDate($bulletinPaie->getPeriodeDebut(), $bulletinPaie->getPeriodeFin());
        $diffDay = $bulletinPaie->getPeriodeFin()->diff($bulletinPaie->getPeriodeDebut())->d;
        //$diffDay = date_diff($bulletinPaie->getPeriodeFin(), $bulletinPaie->getPeriodeDebut());

        return $diffDay - ($nbreweekend + count($holiday));
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

    /**
     * @Route("/pdf/print-pdf", defaults={}, name="paieprintpdf")
     */
    public function print(RhBulletinPaieRepository $paieRepository)
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        //$dql = 'SELECT a.id,a.nomComplet FROM App\Entity\Employe a';
        //$query = $entityManager->createQuery($dql);
        // Retrieve the HTML generated in our twigœ
        $html = $this->renderView('rh_bulletin_paie/pdf.html.twig', [
            'title' => 'Welcome to our PDF Test',
            'bulletins' => $paieRepository->findAll(),
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (inline view)
        $dompdf->stream('mypdf.pdf', [
            'Attachment' => false,
        ]);
    }

    /**
     * @Route("/pdf/print-paie/{id}", defaults={}, name="bulletineprintpdf")
     */
    public function printFeulle(Request $request, RhBulletinPaie $rhBulletinPaie, RhlignereglepaieRepository $repository)
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        $pdfOptions->set('isRemoteEnabled', true);

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        //$dql = 'SELECT a.id,a.nomComplet FROM App\Entity\Employe a';
        //$query = $entityManager->createQuery($dql);
        // Retrieve the HTML generated in our twigœ
        $html = $this->renderView('rh_bulletin_paie/bulletin_pdf.html.twig', [
            'title' => 'Welcome to our PDF Test',
            'bulletin' => $rhBulletinPaie,
            'lines' => $repository->findByBulletinIsRegleVisible($rhBulletinPaie),
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (inline view)
        $dompdf->stream('mypdf.pdf', [
            'Attachment' => false,
        ]);
    }

    // Rest of your original controller

    /**
     * @Route("/delete/rest", name="rh_bulletin_paie_delete_all", methods={"GET"})
     */
    public function deleteRest(Request $request, RhBulletinPaieRepository $repository): JsonResponse
    {
        $rhBulletinPaie = $repository->find($request->get('id_bulletin'));
        $entityManager = $this->getDoctrine()->getManager();
        foreach ($rhBulletinPaie->getRhlignereglepaies() as $ligne) {
            $entityManager->remove($ligne);
        }
        $entityManager->remove($rhBulletinPaie);
        $entityManager->flush();

        return new JsonResponse('ok', 200);
    }
}
