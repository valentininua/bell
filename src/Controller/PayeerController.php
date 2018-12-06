<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PayeerController extends AbstractController
{
    /**
     * ENG::Key to encrypt additional parameters:
     * RUS::Ключ для шифрования дополнительных параметров:
     */
    const KeyAdditionalParameters = '9847659843276598237465';
    /**
     * RUS::Секретный ключ:
     * ENG::SecretKey
     */
    const SecretKey = "872163548726548";

    /**
     * Идентификатор мерчанта зарегистрированного в системе Payeer на который будет совершен платеж
     * The identifier of merchant registered in Payeer system on which will be made payment.
     */
    const m_shop = '691416835';


    /**
     * @return Response
     * @throws \Exception
     */
    public function index()
    {
        $m_shop = self::m_shop;
        $m_orderid = '1';
        $m_amount = number_format(100, 2, '.', '');
        $m_curr = 'USD';
        $m_desc = base64_encode('Test');
        $m_key = 'Your secret key';

        $arHash = array(
            $m_shop,
            $m_orderid,
            $m_amount,
            $m_curr,
            $m_desc
        );

        /*
        $arParams = array(
            'success_url' => 'http://bigbell.net/new_success_url',
            //'fail_url' => 'http://bigbell.net/new_fail_url',
            //'status_url' => 'http://bigbell.net/new_status_url',
            'reference' => array(
                'var1' => '1',
                //'var2' => '2',
                //'var3' => '3',
                //'var4' => '4',
                //'var5' => '5',
            ),
        );

        $key = md5('Key for encryption additional parameters'.$m_orderid);

        $m_params = urlencode(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, json_encode($arParams), MCRYPT_MODE_ECB)));

        $arHash[] = $m_params;
        */

        $arHash[] = $m_key;

        $sign = strtoupper(hash('sha256', implode(':', $arHash)));
        return   $this->render('payeer/index.html.twig',[
            'm_shop' => 'm_shop',
            'm_orderid' => 'm_orderid',
            'm_amount' => 'm_amount',
            'm_curr' =>  'm_curr',
            'm_desc' =>  'm_desc',
            'sign' => 'sign',
            'm_params' => 'm_params',
        ]);
    }

    /**
     * @return Response
     * @throws \Exception
     */
    public function success()
    {
        // URL успешной оплаты:
        return   $this->render('index/index.html.twig');
    }

    /**
     * @return Response
     * @throws \Exception
     */
    public function fail()
    {
        //URL неуспешной оплаты :
        return   $this->render('index/index.html.twig');
    }

    /**
     * @return Response
     * @throws \Exception
     */
    public function status()
    {
        //URL обработчика:
        return   $this->render('index/index.html.twig');
    }

}
