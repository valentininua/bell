<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
    /**
     * @return Response
     * @throws \Exception
     */
    public function index()
    {
        return $this->render('index/index.html.twig');
    }

    /**
     * @return Response
     * @throws \Exception
     */
    public function about()
    {
        return $this->render('index/about.html.twig');
    }
}
