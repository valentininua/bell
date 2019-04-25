<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\Contactform;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends AbstractController
{
    /**
     * @return Response
     * @throws \Exception
     */
    public function index()
    {
        $exchangeRates = file_get_contents('https://api.exmo.com/v1/trades/?pair=BTC_USD,BTC_EUR,LTC_USD,ETH_USD,NEO_USD,USDT_USD');
        $exchangeRates = json_decode($exchangeRates);

        $exchangeRatesReturn = [];
        foreach ($exchangeRates as $k=>$v) {
            $kExchange= str_replace("_", " ", $k);
            foreach ($v as $_k => $_v) {
                $exchangeRatesReturn[$kExchange] = $_v->price;
            }
        }

        return $this->render('index/index.html.twig',[
            'exchangeRates' => $exchangeRatesReturn
        ]);
    }


    public function  contactform(Request $request)
    {
        if (!$request->request->get('email')) {
            return $this->json(['status' => 'false', 'error' => 'не заполнено поле email ' ]);
        }
        if (!$request->request->get('message')) {
            return $this->json(['status' => 'false', 'error' => 'не заполнено поле message ' ]);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $contactform = new Contactform();

        $contactform->setEmail($request->request->get('email'));
        $contactform->setMessage($request->request->get('subject'));
        $contactform->setName($request->request->get('name'));
        $contactform->setSubject($request->request->get('message'));

        $entityManager->persist($contactform);
        $entityManager->flush();

        return $this->json(['status' => 'true']);
    }

    /**
     * @return Response
     * @throws \Exception
     */
    public function howto()
    {
        $user = $this->getUser();
        return $this->render('index/howto.html.twig' , array( 'user' => $user ));
    }

    /**
     * @return Response
     * @throws \Exception
     */
    public function agreement()
    {
        $user = $this->getUser();
        return $this->render('index/agreement.html.twig' , array( 'user' => $user ));
    }

    /**
     * @return Response
     */
    public function training()
    {
        $user = $this->getUser();
        return $this->render('index/training.html.twig' , array( 'user' => $user ));
    }

    /**
     * @return Response
     */
    public function individualRobot()
    {
        $user = $this->getUser();
        return $this->render('index/individualRobot.html.twig' , array( 'user' => $user ));
    }


}
