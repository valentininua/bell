<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class IndexController
{
    /**
     * @return Response
     * @throws \Exception
     */
    public function index()
    {
        $number = random_int(0, 100);

        return new Response(
            '<html><body>  \App\Controller\IndexController::index  number: '.$number.'</body></html>'
        );
    }

    /**
     * @return Response
     * @throws \Exception
     */
    public function admin()
    {
        $number = random_int(0, 100);

        return new Response(
            '<html><body>\App\Controller\IndexController::admin   number: '.$number.'</body></html>'
        );
    }
}
