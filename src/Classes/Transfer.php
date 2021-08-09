<?php
namespace Loecos\Funpay237\Classes;

use Loecos\Funpay237\Classes\Base\ApiCall;
use Loecos\Funpay237\Classes\Base\ApiReponse;
use Loecos\Funpay237\Classes\Enums\PaymentMode;
use Loecos\Funpay237\Classes\Exceptions\RequestException;

class Transfer extends ApiCall
{

    public function init(float $amount, string $type, string $description, string $account_number): array
    {
        if(!in_array($type, [PaymentMode::OM, PaymentMode::MOMO, PaymentMode::EUM])) {
            throw new RequestException("Invalid Payment Mode");
        }
        $data = [
            'amount' => $amount,
            'notif_url' => $this->configuration->getNotifyUrl(),
            'description' => $description,
            'account_number' => $account_number,
            'type' => $type
        ];

        return $this->call('transfers-process','init',$data);

    }

    public function check( string $transaction_id): array
    {
        return $this->call('transfers-process', 'check',['transaction_id' => $transaction_id]);
    }
    public function infos( string $transaction_id) : array
    {
        return $this->call('transfers-process', 'infos',['transaction_id' => $transaction_id]);
    }
}
