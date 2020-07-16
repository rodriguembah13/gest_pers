<?php

/*
 * This file is part of the AdminLTE-Bundle demo.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controller;

use App\Form\FormDemoModelType;
use App\Repository\CurrencyRepository;
use App\Repository\DepartementRepository;
use App\Repository\EmployeRepository;
use App\Repository\EntrepriseRepository;
use App\Repository\HolidayRepository;
use App\Repository\PresenceRepository;
use App\Repository\UserRepository;
use App\Repository\WorkDayRepository;
use Doctrine\ORM\EntityManagerInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
use Knp\Component\Pager\PaginatorInterface;
use Laminas\Json\Expr;
use Ob\HighchartsBundle\Highcharts\Highchart;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Default controller.
 *
 * @IsGranted("ROLE_USER")
 */
class DefaultController extends AbstractController
{
    /**
     * @Route("/", defaults={}, name="homepage")
     */
    public function index(EmployeRepository $employeRepository, PresenceRepository $presenceRepository, UserRepository $userRepository, DepartementRepository $departementRepository)
    {
        $items = $employeRepository->findAll();
        $users = $userRepository->findAll();
        $departements = $departementRepository->findAll();
        $count = count($items);
        $presences = $presenceRepository->findBy(['dateCreation' => new \DateTime()]);
        $arrayDepartementts_code = [];
        $arrayDepartementts_effectifs = [];
        foreach ($departements as $departement) {
            $arrayDepartementts_code[] = $departement->getCode();
            $arrayDepartementts_effectifs[] = count($departement->getEmployes());
        }
        // Chart
        /*   $series = array(
               array("name" => "Data Serie Name", "data" => array(1, 2, 4, 5, 6, 3, 8))
           );
         /*
                   $ob = new Highchart();
                   $ob->chart->renderTo('pie');  // The #id of the div where to render the chart
                   $ob->title->text('Effectif par Departement');
                   $ob->xAxis->title(array('text' => "Horizontal axis title"));
                   $ob->yAxis->title(array('text' => "Vertical axis title"));
                   $ob->series($series);*/
        $series = [
            [
                'name' => 'Employes',
                'type' => 'column',
                'color' => '#4572A7',
                'yAxis' => 1,
              //  'data' => [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4],
                'data' => $arrayDepartementts_effectifs,
            ],
           /*  array(
                 'name'  => 'Temperature',
                 'type'  => 'spline',
                 'color' => '#AA4643',
                 'data'  => array(7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6),
             ),*/
        ];
        $yData = [
            [
                'labels' => [
                   // 'formatter' => new Expr('function () { return this.value + " degrees C" }'),
                    'style' => ['color' => '#AA4643'],
                ],
                'title' => [
                    'text' => 'Effectif',
                    'style' => ['color' => '#AA4643'],
                ],
                'opposite' => true,
            ],
          [
                'labels' => [
                   // 'formatter' => new Expr('function () { return this.value + " mm" }'),
                    'style' => ['color' => '#4572A7'],
                ],
                'gridLineWidth' => 0,
                'title' => [
                    'text' => 'Effectif',
                    'style' => ['color' => '#4572A7'],
                ],
            ],
        ];
        $categories = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        $ob = new Highchart();
        $ob->chart->renderTo('container'); // The #id of the div where to render the chart
        $ob->chart->type('column');
        $ob->title->text('Effectif par Departement');
        $ob->xAxis->categories($arrayDepartementts_code);
        $ob->yAxis($yData);
        $ob->legend->enabled(true);
        /*    $formatter = new Expr('function () {
                     var unit = {
                         "Rainfall": "mm",
                         "Temperature": "degrees C"
                     }[this.series.name];
                     return this.x + ": <b>" + this.y + "</b> " + unit;
                 }');
            $ob->tooltip->formatter($formatter);*/
        $ob->series($series);

        return $this->render('default/index.html.twig', [
            'nbemp' => $count, 'nbusers' => count($users), 'nbdepartements' => count($departements),
            'precences' => count($presences), 'chart' => $ob,
        ]);
    }

    /**
     * @Route("/config-rh", defaults={}, name="configpage")
     */
    public function config(UserRepository $userRepository, EntrepriseRepository $entrepriseRepository, CurrencyRepository $currencyRepository, WorkDayRepository $workDayRepository, HolidayRepository $holidayRepository, EntityManagerInterface $em, PaginatorInterface $paginator, Request $request)
    {
        $dql = 'SELECT a FROM App\Entity\User a';
        $query = $em->createQuery($dql);
        $pagination = $paginator->paginate($query, $request->query->getInt('page', 1), 100);

        return $this->render('default/config.html.twig', [
            'users' => $pagination,
            'nbholydays' => count($holidayRepository->findByBetweenDate('2020-01-01', '2020-01-31')),
            'entreprises' => count($entrepriseRepository->findAll()),
            'currencies' => count($currencyRepository->findAll()),
            'workdays' => count($workDayRepository->findAll()),
        ]);
    }

    /**
     * @Route("/forms", defaults={}, name="forms")
     */
    public function forms(Request $request)
    {
        $form = $this->createForm(FormDemoModelType::class);
        $form = $this->handleForm($request, $form);

        return $this->render('default/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/forms2", defaults={}, name="forms2")
     */
    public function forms2(Request $request)
    {
        $form = $this->createForm(FormDemoModelType::class);
        $form = $this->handleForm($request, $form);

        return $this->render('default/form-horizontal.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/forms3", defaults={}, name="forms3")
     */
    public function forms3(Request $request)
    {
        $form = $this->createForm(FormDemoModelType::class);
        $form = $this->handleForm($request, $form);

        return $this->render('default/form-sidebar.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    protected function handleForm(Request $request, FormInterface $form)
    {
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $this->addFlash('success', 'Fantastic work! You nailed it, form has no errors :-)');
            } else {
                $this->addFlash('error', 'Form has errors ... please fix them!');
            }
        }

        return $form;
    }

    /**
     * @Route("/context", defaults={}, name="context")
     */
    public function context()
    {
        return $this->render('default/context.html.twig', []);
    }

    public function userPreferences()
    {
        return $this->render('control-sidebar/settings.html.twig', []);
    }

    /**
     * @Route("/print-pdf", defaults={}, name="printpdf")
     */
    public function print()
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('default/mypdf.html.twig', [
            'title' => 'Welcome to our PDF Test',
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
