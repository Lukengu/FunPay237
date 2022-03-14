<?php
namespace Loecos\Funpay237\Classes;


use GuzzleHttp\Exception\GuzzleException;
use Loecos\Funpay237\Classes\Base\ApiCall;
use Loecos\Funpay237\Classes\Base\ApiReponse;
use Loecos\Funpay237\Classes\Enums\PaymentMode;
use Loecos\Funpay237\Classes\Exceptions\RequestException;

class Payment extends ApiCall
{
    /**
     * @param $transaction_id
     * @return array
     * @throws GuzzleException
     */
    public function cancel($transaction_id)
    {
        return $this->call('payments-process', 'cancel',['transaction_id' => $transaction_id]);

    }

    /**
     * @param string $transaction_id
     * @return array
     * @throws GuzzleException
     */
    public function check( string $transaction_id)
    {
        return $this->call('payments-process', 'check',['transaction_id' => $transaction_id]);
    }

    /**
     * @param string $transaction_id
     * @return array
     * @throws GuzzleException
     */
    public function infos( string $transaction_id)
    {
        return $this->call('payments-process', 'infos',['transaction_id' => $transaction_id]);
    }


    /**
     * @param float $amount
     * @param string $type
     * @param string $description
     * @param string $account_number
     * @return array
     * @throws GuzzleException
     * @throws RequestException
     */
    public function init(float $amount, string $type, string $description, string $account_number)
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
<<<<<<< HEAD
    /**
=======
     /**
>>>>>>> b7aa36a2da003381ac1f3b5bbb94d25a2a8baeb6
     * @param string $transaction_id
     * @return array
     */
    public function process(string $transaction_id)
    {
        $data = [
            'transaction_id' =>  $transaction_id,
        ];
        return $this->call('payments-process','run',$data);

    }
}
