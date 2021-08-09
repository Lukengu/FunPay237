<?php


namespace Loecos\Funpay237\Classes\Base;

use GuzzleHttp\Client;

abstract class ApiCall implements Payable
{
    protected $configuration;
    protected $client;
    protected $endpoint;


    public function __construct(Config $configuration)
    {
        $this->configuration =  $configuration;
        $this->client = new Client();

    }
    private function buildUrl(string $module, string $action)
    {
        return $this->configuration->getBaseEndpoint()."api/{$module}/${action}";

    }

    protected function call( string $module, string $action, array $data=[], string $method="post") : ApiReponse
    {
        if(!in_array($method,['post'])){
            throw new RequestException("Method not allowed");
        }
        $this->endpoint = $this->buildUrl($module, $action);
        $data['api_key'] = $this->configuration->getApiKey();
        $data['secret'] = $this->configuration->getApiSecret();
        return $this->postRequest($data);

    }

    private function postRequest(array $data)
    {
        $data = ['json' => $data];
        $response = $this->client->post($this->endpoint, $data, [
            'auth' => [$this->configuration->getApiKey(), $this->configuration->getApiSecret()]]);

        $response =  new ApiReponse($response->getBody()->getContents());
        return $response->getResults();
    }
}
