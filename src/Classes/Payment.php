<?php
namespace Loecos\Funpay237\Classes;


use Loecos\Funpay237\Classes\Base\ApiCall;
use Loecos\Funpay237\Classes\Base\ApiReponse;
use Loecos\Funpay237\Classes\Enums\PaymentMode;
use Loecos\Funpay237\Classes\Exceptions\RequestException;

class Payment extends ApiCall
{

    public function cancel($transaction_id)
    {
        return $this->call('payments-process', 'cancel',['transaction_id' => $transaction_id]);

    }

    public function check( string $transaction_id)
    {
        return $this->call('payments-process', 'check',['transaction_id' => $transaction_id]);
    }
    public function infos( string $transaction_id)
    {
        return $this->call('payments-process', 'infos',['transaction_id' => $transaction_id]);
    }



    public function init(float $amount, string $type, string $description, string $account_number): ApiReponse
    {
        if(!in_array($type, [PaymentMode::OM, PaymentMode::MOMO, PaymentMode::EUM])) {
            throw new RequestException("Invalid Payment Mode");
        }
        $data = [
            'amount' =>  $amount,
            'notif_url' => $this->configuration->getNotifyUrl(),
            'return_url' => $this->configuration->getReturnUrl(),
            'type' => $type,
            'description' => $description,
            'account_number' => $account_number,
        ];

        return $this->call('payments-process','init',$data);

    }
}
