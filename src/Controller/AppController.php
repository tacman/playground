<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class AppController extends AbstractController
{
    #[Route('/landing', name: 'app_landing')]
    public function landing(): Response
    {
        return $this->render('app/landing.html.twig', [
        ]);
    }

    #[Route('/tabler', name: 'app_tabler')]
    public function tabler(): Response
    {
        return $this->render('app/tabler.html.twig', [
        ]);
    }

    #[Route('/', name: 'app_homepage')]
    #[Route('/simple-datatable', name: 'app_simple-datatable')]
    public function simple_datatable(): Response
    {
        return $this->render('app/simple_datatable.html.twig', [
        ]);
    }

    #[Route('/chart', name: 'app_chart')]
    public function index(ChartBuilderInterface $chartBuilder): Response
    {
        $chart = $chartBuilder->createChart(Chart::TYPE_LINE);

        $chart->setData([
            'labels' => ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            'datasets' => [
                [
                    'label' => 'My First dataset',
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => [0, 10, 5, 2, 20, 30, 45],
                ],
            ],
        ]);

        $chart->setOptions([
            'scales' => [
                'y' => [
                    'suggestedMin' => 0,
                    'suggestedMax' => 100,
                ],
            ],
        ]);

        return $this->render('app/index.html.twig', [
            'chart' => $chart,
        ]);
    }
}
