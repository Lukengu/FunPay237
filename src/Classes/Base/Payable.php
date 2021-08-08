<?php


namespace Loecos\Funpay237\Classes\Base;


interface Payable
{

    public function init(float $amount, string $type, string $description, string $account_number): ApiReponse;
    public function check(string $transaction_id): ApiReponse;
    public function infos(string $transaction_id): ApiReponse;

}
