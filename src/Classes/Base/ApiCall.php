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

    /**
     * @param string $module
     * @param string $action
     * @return string
     */
    private function buildUrl(string $module, string $action)
    {
        return $this->configuration->getBaseEndpoint()."api/{$module}/${action}";

    }

    /**
     * @param string $module
     * @param string $action
     * @param array $data
     * @param string $method
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function call( string $module, string $action, array $data=[], string $method="post")
    {
        if(!in_array($method,['post'])){
            throw new RequestException("Method not allowed");
        }
        $this->endpoint = $this->buildUrl($module, $action);
        $data['api_key'] = $this->configuration->getApiKey();
        $data['secret'] = $this->configuration->getApiSecret();
        try {
            return $this->postRequest($data);
        } catch(GuzzleHttp\Exception\ClientException $e) {
            throw new RequestException($e->getMessage());

        }

    }

    /**
     * @param array $data
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function postRequest(array $data)
    {
        $data = ['json' => $data];
        $response = $this->client->post($this->endpoint, $data, [
            'auth' => [$this->configuration->getApiKey(), $this->configuration->getApiSecret()]]);

        $response =  new ApiReponse($response->getBody()->getContents());
        return $response->getResults();
    }
}
