<?php
namespace Loecos\Funpay237\Classes;

use GuzzleHttp\Exception\GuzzleException;
use Loecos\Funpay237\Classes\Base\ApiCall;
use Loecos\Funpay237\Classes\Base\ApiReponse;
use Loecos\Funpay237\Classes\Enums\PaymentMode;
use Loecos\Funpay237\Classes\Exceptions\RequestException;

class Transfer extends ApiCall
{
    /**
     * @param float $amount
     * @param string $type
     * @param string $description
     * @param string $account_number
     * @return array
     * @throws RequestException
     * @throws GuzzleException
     */
    public function init(float $amount, string $type, string $description, string $account_number)
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

    /**
     * @param string $transaction_id
     * @return array
     * @throws GuzzleException
     */
    public function check( string $transaction_id)
    {
        return $this->call('transfers-process', 'check',['transaction_id' => $transaction_id]);
    }

    /**
     * @param string $transaction_id
     * @return array
     * @throws GuzzleException
     */
    public function infos( string $transaction_id)
    {
        return $this->call('transfers-process', 'infos',['transaction_id' => $transaction_id]);
    }
}
