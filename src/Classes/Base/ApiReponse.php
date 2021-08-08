<?php


namespace Loecos\Funpay237\Classes\Base;


class ApiReponse
{

    protected $allowed_keys = [
        'transaction_id',
        'invoice_id',
        'expired_at',
        'redirect_url',
        'status',
        'operation',
        'message',
        'amount',
        'account_number',
        'type',
        'created_at',
        'reference',
        'description',
        'decision_date',

    ];

    protected $results = [];
    protected  $json;

    public function __construct( string $json)
    {
        $this->json = $json;
        $data = json_decode($json);

        foreach($data as $key => $value)
        {
            $this->{$key} = $value;
        }

    }

    private function __set($name, $value)
    {
        if (!array_key_exists($name, $this->allowed_keys)){
            $this->results[$name] = $value;
        }

    }

    public function __get($name)
    {
        return  $this->results[$name];
    }
    public function getJson()
    {
        return $this->json;
    }

}
