<?php


namespace Loecos\Funpay237\Classes\Base;


use Loecos\Funpay237\Classes\Exceptions\ConfigurationException;

class Config
{
    private $base_endpoint;
    private $api_key;
    private $api_secret;
    private $return_url;
    private $notify_url;



    public function __construct()
    {
        $config = config('funpay');
        if(!$config) {
            throw new ConfigurationException("Configuration not set");
        }

        if(!isset($config['base_endpoint'])){
            throw new ConfigurationException("Base Api Url required");
        }
        $this->base_endpoint = $config['base_endpoint'];

        if(!isset($config['api_key'])){
            throw new ConfigurationException("Api key required");
        }
        $this->api_key = $config['api_key'];


        if(!isset($config['api_secret'])){
            throw new ConfigurationException("Api Secret required");
        }
        $this->api_secret = $config['api_secret'];

        if(!isset($config['return_url'])){
            throw new ConfigurationException("Return Url required");
        }
        $this->return_url = $config['return_url'];


        if(!isset($config['notify_url'])){
            throw new ConfigurationException("Notify Url required");
        }
        $this->notify_url = $config['notify_url'];
    }

    /**
     * @return string
     */
    public function getBaseEndpoint() : string
    {
        return $this->base_endpoint;
    }

    /**
     * @return string
     */
    public function getApiKey() : string
    {
        return $this->api_key;
    }

    /**
     * @return string
     */
    public function getApiSecret(): string
    {
        return $this->api_secret;
    }

    /**
     * @return string
     */
    public function getReturnUrl() : string
    {
        return  $this->notify_url;
    }

    /**
     * @return string
     */
    public function getNotifyUrl() : string
    {
        return $this->notify_url;
    }


}
