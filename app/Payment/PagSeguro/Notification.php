<?php


namespace App\Payment\PagSeguro;


use PagSeguro\Configuration\Configure;
use PagSeguro\Helpers\Xhr;

class Notification
{
    public function getTransaction()
    {
        if (!Xhr::hasPost()) throw new \InvalidArgumentException($_POST);

        $response = \PagSeguro\Services\Transactions\Notification::check(
                Configure::getAccountCredentials()
            );

        return $response;

    }
}
