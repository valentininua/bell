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
       // var_dump($user->balance);exit;

        return $this->render('admin/admin.html.twig', array(
            'user' => $user,
        ));
    }
}
