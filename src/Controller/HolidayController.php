<?php

namespace App\Controller;

use App\Entity\Holiday;
use App\Form\HolidayType;
use App\Repository\HolidayRepository;
use Doctrine\ORM\EntityManagerInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/holiday")
 */
class HolidayController extends AbstractController
{
    /**
     * @Route("/", name="holiday_index", methods={"GET"})
     */
    public function index( EntityManagerInterface $em,HolidayRepository $holidayRepository,PaginatorInterface $paginator, Request $request): Response
    {
        $dql = 'SELECT a FROM App\Entity\Holiday a';
        $query = $em->createQuery($dql);
        $pagination = $paginator->paginate($query, $request->query->getInt('page', 1), 12);
        return $this->render('holiday/index.html.twig', [
            'holidays' => $pagination,
        ]);
    }
    /**
     * @Route("/print-pdf", defaults={}, name="holidayprintpdf")
     */
    public function print(HolidayRepository $holidayRepository)
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('holiday/pdf.html.twig', [
            'title' => 'Welcome to our PDF Test',
            'holidays' => $holidayRepository->findAll(),
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
     * @Route("/new", name="holiday_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $holiday = new Holiday();
        $form = $this->createForm(HolidayType::class, $holiday);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($holiday);
            $entityManager->flush();

            return $this->redirectToRoute('holiday_index');
        }

        return $this->render('holiday/new.html.twig', [
            'holiday' => $holiday,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="holiday_show", methods={"GET"})
     */
    public function show(Holiday $holiday): Response
    {
        return $this->render('holiday/show.html.twig', [
            'holiday' => $holiday,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="holiday_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Holiday $holiday): Response
    {
        $form = $this->createForm(HolidayType::class, $holiday);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('holiday_index');
        }

        return $this->render('holiday/edit.html.twig', [
            'holiday' => $holiday,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="holiday_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Holiday $holiday): Response
    {
        if ($this->isCsrfTokenValid('delete'.$holiday->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($holiday);
            $entityManager->flush();
        }

        return $this->redirectToRoute('holiday_index');
    }
}
