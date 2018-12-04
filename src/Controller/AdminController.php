<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Services\ReportService;

class AdminController extends AbstractController
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
     * @throws \Exception
     */
    public function index()
    {
        $user = $this->getUser();
        return $this->render('admin/admin.html.twig', array(
            'user' => $user,
            'report'  => $this->reportService->getReport($user)
        ));
    }
}
