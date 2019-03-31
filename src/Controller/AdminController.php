<?php

namespace App\Controller;

use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Services\ReportService;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\{Report,Withdraw, Training};

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

        if (!$user) {
            return $this->render('index/index.html.twig');
        }

        $money = 75;

        $m_shop = getenv('m_shop');
        $m_orderid = (int) $user->getId();
        $m_amount = number_format($money, 2, '.', '');
        $m_curr = getenv('USD');
        $m_desc = base64_encode('Вступительный взнос (Entrance fee) ' .  'id' . $user->getId() . " , Email " . $user->getEmail() . ' ');
        $m_key = getenv('m_key');

        $arHash = array(
            $m_shop,
            $m_orderid,
            $m_amount,
            $m_curr,
            $m_desc
        );

        $arHash[] = $m_key;
        $sign = strtoupper(hash('sha256', implode(':', $arHash)));

        return $this->render('admin/admin.html.twig', array(
            'user' => $user,
            'report' => $this->reportService->getReport($user),

            'money' => $money,
            'm_shop' => $m_shop,
            'm_orderid' => $m_orderid,
            'm_amount' => $m_amount,
            'm_curr' => $m_curr,
            'm_desc' => $m_desc,
            'sign' => $sign,
        ));


    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function ajaxInvest(Request $request)
    {
        if ((int)$request->get('idValue') >= 100) {
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

    /**
     * @return Response
     */
    public function verify()
    {
        $user = $this->getUser();
        return $this->render('admin/verify.html.twig', array(
            'user' => $user,
            'report' => $this->reportService->getReport($user)
        ));
    }

    /**
     * @return Response
     */
    public function add()
    {
        $user = $this->getUser();
        return $this->render('admin/add.html.twig', array(
            'user' => $user,
            'report' => $this->reportService->getReport($user),
        ));
    }

    /**
     * @return Response
     */
    public function addConfirm(Request $request)
    {
        $money = (int) $request->get('money');
        $user = $this->getUser();
        if (!$user) {
            return $this->render('index/index.html.twig');
        }
        $m_shop = getenv('m_shop');
        $m_orderid = (int) $user->getId();
        $m_amount = number_format($money, 2, '.', '');
        $m_curr = getenv('USD');
        $m_desc = base64_encode('id' . $user->getId() . " , Email " . $user->getEmail());
        $m_key = getenv('m_key');

        $arHash = array(
            $m_shop,
            $m_orderid,
            $m_amount,
            $m_curr,
            $m_desc
        );

        $arHash[] = $m_key;

        $sign = strtoupper(hash('sha256', implode(':', $arHash)));

        return $this->render('admin/addConfirm.html.twig', [
            'report' => $this->reportService->getReport($user),
            'user' => $user,
            'money' => $money,
            'm_shop' => $m_shop,
            'm_orderid' => $m_orderid,
            'm_amount' => $m_amount,
            'm_curr' => $m_curr,
            'm_desc' => $m_desc,
            'sign' => $sign,
        ]);
    }

    /**
     * @return Response
     */
    public function withdraw()
    {
        $user = $this->getUser();
        return $this->render('admin/withdraw.html.twig', array(
            'user' => $user,
            'report' => $this->reportService->getReport($user),
        ));
    }

    /**
     * @return Response
     */
    public function withdrawConfirm(Request $request)
    {
        $user = $this->getUser();
        $money = (int) $request->get('money');
        $confirm = (int) $request->get('confirm');
        $accountNumber = trim($request->get('accountNumber'));
        $reportUser = $this->reportService->getReport($user);
        $error = [];
        if (1 == $confirm) {

            $isavailable = $reportUser['available_funds'] - (int)$request->get('money') < 0;

            if ('' == $accountNumber) {
                $error[] = "Операция не выполнена , номер счета не заполнен";
            }
            if ( $isavailable ) {
                $error[] = "Операция не выполнена , остатком не может быть меньше нуля";
            }
            if ( (int)$request->get('money') < 0 ) {
                $error[] = "Операция не выполнена , не может быть меньше нуля";
            }

            if ( 0 == count($error) ) {
                $report = new Report();
                $em = $this->getDoctrine()->getManager();
                $report->setUid( (int) $user->getId());
                $report->setCurrentAccount("-" . (int)$request->get('money'));
                $em->persist($report);
                $em->flush();

                $withdraw = new Withdraw();
                $withdraw->setUid( (int) $user->getId());
                $withdraw->setBalanceOutput((int)$request->get('money'));
                $withdraw->setAccountNumber($accountNumber);
                $em->persist($withdraw);
                $em->flush();
            }
        }

        return $this->render('admin/withdrawConfirm.html.twig', array(
            'accountNumber' => $accountNumber,
            'money' => $money,
            'user' => $user,
            'report' => $this->reportService->getReport($user), // recount
            'confirm' => $confirm,
            'error' => $error
        ));
    }

    /**
     * @return Response
     */
    public function training()
    {
        $user = $this->getUser();
        // Training
        $repository = $this->getDoctrine()->getRepository(Training::class);
        $training = $repository->findBy(array('uid' => (int) $user->getId() ));

        return $this->render('admin/training.html.twig', array(
            'user' => $user,
            'report' => $this->reportService->getReport($user),
            'training' => $training,
        ));
    }

    /**
     * @return Response
     */
    public function payeer()
    {$user = $this->getUser();
        return $this->render('admin/payeer.html.twig');
    }

}
