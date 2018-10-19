<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * @return Response
     * @throws \Exception
     */
    public function index()
    {
        $user = $this->getUser();
        return $this->render('admin/admin.html.twig', array(
            'user' => $user,
            'balance' =>  "$ 12 000.00",
        ));
    }
}
