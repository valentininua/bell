<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Services\ReportService;

use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\HttpFoundation\Request;

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
    /**
     * @return Response
     * @throws \Exception
     */
    public function ajaxInvest()
    {
        //        $user = $this->getUser();
        //        $request = Request::createFromGlobals();
        //        $this->getDoctrine()->getManager();
        //
        //        $Report = new Report();
        //
        //
        ////        $this->reportService->setReport([
        ////           'user' => $user,
        ////            'post' =>[
        ////                'idValue' => 1,//$request->query->post('idValue'),
        ////                'id' => 2,//$request->query->post('id')
        ////            ]
        ////        ]);
        return new  JsonResponse([1]);
    }
}
