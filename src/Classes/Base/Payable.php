<?php


namespace Loecos\Funpay237\Classes\Base;


interface Payable
{

    public function init(float $amount, string $type, string $description, string $account_number);
    public function check(string $transaction_id);
    public function infos(string $transaction_id);

}
