<?php

namespace App\Controller;

use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Services\{ReportService,UserService};

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\{Report,Withdraw, Training, User};

class RootController extends AbstractController
{
    /**
     * @var ReportService
     */
    private $reportService;

    /**
     * @var UserService
     */
    private $userService;





    /**
     * AdminController constructor.
     * @param ReportService $reportService
     */
    public function __construct(ReportService $reportService , UserService  $userService )
    {
        $this->reportService = $reportService;
        $this->userService = $userService;
    }

    /**
     * @return Response
     * @throws \Exception
     */
    public function user($id)
    {

        $user = $this->getUser();
        if (1 !== (int) $user->getIsadmin()) {
            $this->redirect('https://globalbigbell.com');
        }

        $user = $this->getUser();
        if (1 !== (int) $user->getIsadmin()) {
            return $this->redirectToRoute('app_index');
        }
        // TODO :: edit all
        $report = $this->getDoctrine()->getRepository(Report::class);
        $productReport = $report->findAll();

        $reportUser = $this->getDoctrine()->getRepository(User::class);
        $productUsers = $reportUser->findAll();

        return $this->render('root/user.html.twig',[
            'user' => $user,
            'report' => $this->reportService->getReport($user),
            'productReport' => $productReport,
            'productUsers' => $productUsers,
        ]);


    }



}
