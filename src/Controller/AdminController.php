<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\Report;
class AdminController extends AbstractController
{
    /**
     * @return Response
     * @throws \Exception
     */
    public function index()
    {


        $product = $this->getDoctrine()
            ->getRepository(Report::class)
            ->find(1);
var_dump($product);
exit();
        $user = $this->getUser();
       // var_dump($user->balance);exit;

        return $this->render('admin/admin.html.twig', array(
            'user' => $user,
        ));
    }
}
