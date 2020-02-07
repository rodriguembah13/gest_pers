<?php

namespace App\Controller;

use App\Entity\Employe;
use App\Entity\User;
use App\Form\EmployeType;
use App\Form\UploadExelType;
use App\Repository\DepartementRepository;
use App\Repository\EmployeRepository;
use App\Repository\PosteRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/employe")
 * @IsGranted("ROLE_ADMIN")
 */
class EmployeController extends AbstractController
{
    /**
     * @Route("/", name="employe_index", methods={"GET"})
     */
    public function index(EmployeRepository $employeRepository, EntityManagerInterface $em, PaginatorInterface $paginator, Request $request): Response
    {
        $dql = 'SELECT a FROM App\Entity\Employe a';
        $query = $em->createQuery($dql);
        $pagination = $paginator->paginate($query, $request->query->getInt('page', 1), 12);

        return $this->render('employe/index.html.twig', [
            'employes' => $pagination,
        ]);
    }

    /**
     * @Route("/new", name="employe_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $employe = new Employe();
        //$userManager = $this->get('fos_user.user_manager');
        $form = $this->createForm(EmployeType::class, $employe);
        $form->handleRequest($request);

        // dump($form);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $imageFilename */
            $imageFilename = $form['imageFilename']->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $employe->setMatricule($employe->getPoste()->getCode().$this->randomMatricule());
            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($imageFilename) {
                $destination = $this->getParameter('kernel.project_dir').'/public/uploads';
                $originalFilename = pathinfo($imageFilename->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = Urlizer::urlize($originalFilename).'-'.uniqid().'.'.$imageFilename->guessExtension();
                /*  $imageFilename->move(
                      $destination,
                      $newFilename
                  );*/

                // Move the file to the directory where brochures are stored
                try {
                    $imageFilename->move(
                        $destination,
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $employe->setImageFilename($newFilename);
            }
            $entityManager->persist($employe);
            $entityManager->flush();

            return $this->redirectToRoute('employe_index');
        }

        return $this->render('employe/new.html.twig', [
            'employe' => $employe,
            'form' => $form->createView(),
        ]);
    }

    // Rest of your original controller

    /**
     * Returns a JSON string with the neighborhoods of the City with the providen id.
     */
    public function listpost(Request $request, PosteRepository $posteRepository): JsonResponse
    {
        // Get Entity manager and repository
        $em = $this->getDoctrine()->getManager();
        // $neighborhoodsRepository = $em->getRepository('AppBundle:Neighborhood');

        // Search the neighborhoods that belongs to the city with the given id as GET parameter "cityid"
        $neighborhoods = $posteRepository->createQueryBuilder('q')
            ->where('q.departement = :cityid')
            ->setParameter('cityid', $request->query->get('cityid'))
            ->getQuery()
            ->getResult();

        // Serialize into an array the data that we need, in this case only name and id
        // Note: you can use a serializer as well, for explanation purposes, we'll do it manually
        $responseArray = [];
        foreach ($neighborhoods as $neighborhood) {
            $responseArray[] = [
                'id' => $neighborhood->getId(),
                'libelle' => $neighborhood->getLibelle(),
            ];
        }

        // Return array with structure of the neighborhoods of the providen city id
        return new JsonResponse($responseArray);

        // e.g
        // [{"id":"3","name":"Treasure Island"},{"id":"4","name":"Presidio of San Francisco"}]
    }

    /**
     * @Route("/{id}", name="employe_show", methods={"GET"})
     */
    public function show(Employe $employe): Response
    {
        return $this->render('employe/show.html.twig', [
            'employe' => $employe,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="employe_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Employe $employe): Response
    {
        $form = $this->createForm(EmployeType::class, $employe);
        $form->handleRequest($request);
        /*$form->isSubmitted() && $form->isValid()) {
            $imageFilename = $form['imageFilename']->getData();
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('employe_index');
        }*/
        if ($form->isSubmitted() && $form->isValid()) {
            $imageFilename = $form['imageFilename']->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $employe->setMatricule($employe->getPoste()->getCode().$this->randomMatricule());
            if ($imageFilename) {
                $destination = $this->getParameter('kernel.project_dir').'/public/uploads';
                $originalFilename = pathinfo($imageFilename->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $originalFilename.'-'.uniqid().'.'.$imageFilename->guessExtension();

                try {
                    $imageFilename->move(
                        $destination,
                        $newFilename
                    );
                } catch (FileException $e) {
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $employe->setImageFilename($newFilename);
            }
            $entityManager->persist($employe);
            $entityManager->flush();

            return $this->redirectToRoute('employe_index');
        }

        return $this->render('employe/edit.html.twig', [
            'employe' => $employe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="employe_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Employe $employe): Response
    {
        if ($this->isCsrfTokenValid('delete'.$employe->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($employe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('employe_index');
    }

    /**
     * @Route("/upload/test", name="employe_upload", methods={"GET","POST"})
     */
    public function upload(Request $request): Response
    {
        /*if ($this->isCsrfTokenValid('delete'.$employe->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($employe);
            $entityManager->flush();
        }*/
        /*$form = $this->createForm(UploadExelType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {*/
        //$uploadFilename = $form['file']->getData();
        //$uploadFilename = $request->request->get('file')->getData();
        $uploadFilename = $request->files->get('file');
        if (empty($uploadFilename)) {
            return new Response('nafile', Response::HTTP_INTERNAL_SERVER_ERROR, ['']);
        }
        if ($uploadFilename) {
            $destination = $this->getParameter('kernel.project_dir').'/public/uploads/xls/';
            $originalFilename = pathinfo($uploadFilename->getClientOriginalName(), PATHINFO_FILENAME);
            $newFilename = $originalFilename.'-'.uniqid().'.'.$uploadFilename->guessExtension();
            try {
                $uploadFilename->move(
                    $destination,
                    $newFilename
                );
            } catch (FileException $e) {
            }
            $spreadsheet = $this->get('phpspreadsheet')->createSpreadsheet('file.xlsx');
            // updates the 'brochureFilename' property to store the PDF file name
            // instead of its contents
            //$employe->setImageFilename($newFilename);
            //}
        }

        return $this->redirectToRoute('employe_index');
    }

    private function randomMatricule()
    {
        return rand(5, 15);
    }

    /**
     * @Route("/pdf/print2-pdf", defaults={}, name="employeprintpdf")
     */
    public function print(EmployeRepository $employeRepository)
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        //$dql = 'SELECT a.id,a.nomComplet FROM App\Entity\Employe a';
        //$query = $entityManager->createQuery($dql);
        // Retrieve the HTML generated in our twigœ
        $html = $this->renderView('employe/pdf.html.twig', [
            'title' => 'Welcome to our PDF Test',
            'employes' => $employeRepository->findAll(),
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
}
