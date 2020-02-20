<?php

namespace App\Controller;

use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Services\ReportService;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\{Report,Withdraw, Training};

class ServicesController extends AbstractController
{
    /**
     * @var ReportService
     */
    private $reportService;

    /**
     * AdminController constructor.
     * @param ReportService $reportService
     */
    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    /**
     * @return Response
     */
    public function thailandPropertyInvestments()
    {
        $user = $this->getUser();
        return $this->render('services/thailandPropertyInvestments.html.twig',
            [
                'user' => $user,
                'report' => $this->reportService->getReport($user),
            ]);
    }

    /**
     * @return Response
     */
    public function ipo()
    {
        $user = $this->getUser();
        return $this->render('services/ipo.html.twig',
            [
                'user' => $user,
                'report' => $this->reportService->getReport($user),
            ]);
    }

    /**
     * @return Response
     */
    public function roboticTrading()
    {
        $user = $this->getUser();
        return $this->render('services/roboticTrading.html.twig',
            [
                'user' => $user,
                'report' => $this->reportService->getReport($user),
            ]);
    }

    /**
     * @return Response
     */
    public function individualManagement()
    {
        $user = $this->getUser();
        return $this->render('services/individualManagement.html.twig',
            [
                'user' => $user,
                'report' => $this->reportService->getReport($user),
            ]);
    }


    /**
     * @return Response
     */
    public function cars()
    {
        $user = $this->getUser();
        return $this->render('services/cars.html.twig',
            [
                'user' => $user,
                'report' => $this->reportService->getReport($user),
            ]);
    }

    /**
     * @return Response
     */
    public function hedgeFund()
    {
        $user = $this->getUser();
        return $this->render('services/hedgeFund.html.twig',
            [
                'user' => $user,
                'report' => $this->reportService->getReport($user),
            ]);
    }


    /**
     * @return Response
     */
    public function one()
    {
        $user = $this->getUser();
        return $this->render('services/1-geka.html.twig',
            [
                'user' => $user,
                'report' => $this->reportService->getReport($user),
            ]);
    }

     /**
     * @return Response
     */
    public function two()
    {
        $user = $this->getUser();
        return $this->render('services/2-zeus.html.twig',
            [
                'user' => $user,
                'report' => $this->reportService->getReport($user),
            ]);
    }

    /**
     * @return Response
     */
    public function three()
    {
        $user = $this->getUser();
        return $this->render('services/3-balanced.html.twig',
            [
                'user' => $user,
                'report' => $this->reportService->getReport($user),
            ]);
    }



    /**
     * @return Response
     */
    public function four()
    {
        $user = $this->getUser();
        return $this->render('services/4-credit.html.twig',
            [
                'user' => $user,
                'report' => $this->reportService->getReport($user),
            ]);
    }


}
