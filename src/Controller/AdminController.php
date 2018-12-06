<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Services\ReportService;

use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\HttpFoundation\Request;

use App\Entity\Report;

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
     * @param Request $request
     * @return JsonResponse
     */
    public function ajaxInvest( Request $request)
    {
        if ((int) $request->get('idValue') >= 100) {
            // todo::check balance before save !!!!
            $user = $this->getUser();
            $report = new Report();

            $em = $this->getDoctrine()->getManager();

            if ($request->get('id') === 'Conservative') {
                $report->setUid($user->getId());
                $report->setBalanceConservative((int)$request->get('idValue'));
                $report->setCurrentAccount("-" . (int)$request->get('idValue'));
                $em->persist($report);
                $em->flush();
            }
            if ($request->get('id') === 'Optimal') {
                $report->setUid($user->getId());
                $report->setBalanceOptimum((int)$request->get('idValue'));
                $report->setCurrentAccount("-" . (int)$request->get('idValue'));
                $em->persist($report);
                $em->flush();
            }
            if ($request->get('id') === 'IPO') {
                $report->setUid($user->getId());
                $report->setBalanceIpo((int)$request->get('idValue'));
                $report->setCurrentAccount("-" . (int)$request->get('idValue'));
                $em->persist($report);
                $em->flush();
            }
        }
        return new  JsonResponse([true]);
    }

    public function withdraw()
    {
        return $this->render('index/index.html.twig');
    }

}
