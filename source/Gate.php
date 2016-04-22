<?php

namespace fritak\TescoApiPhp;

use fritak\TescoApiPhp\Config;
use fritak\TescoApiPhp\Response;

/**
 * Gate for communication with Tesco api.
 *
 * @package fritak\TescoApiPhp
 */
class Gate
{
    /** @var fritak\TescoApiPhp\Config Config for application */
    public $config;
    
    const URL_DEFAULT          = 'https://dev.tescolabs.com';
    const URL_GROCERY_PRODUCTS = '/grocery/products/';
    
    const TYPE_GET  = 'GET';
    const TYPE_POST = 'POST';

    public function __construct(Config &$config)
    {
        $this->config = &$config;
    }
    
    /**
     * Request to API
     *
     * @param string $requestUrl Url for request.
     * @param array $data Data for send.
     * @param string $type Type of request GET/POST
     * @return fritak\TescoApiPhp\Response
     */
    public function request($requestUrl, $data = [], $type = self::TYPE_GET)
    {
        $callUrl = self::URL_DEFAULT . $requestUrl;

        if($type === self::TYPE_GET) 
        {
            $callUrl .= '?' . $this->prepareData($data);
        }

        $curl = curl_init($callUrl);
        
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->getHeaders());
        curl_setopt($curl, CURLOPT_HEADER, 0);
        
        if($type === self::TYPE_POST) 
        {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $this->prepareData($data));
        }

        $response = new Response(curl_exec($curl));
        
        $curlError = curl_error($curl);
        if(!empty($curlError))
        {
            throw new \Exception('Gate exception (curl error) #3: ' . $curlError);
        }
        
        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if($statusCode != 200)
        {
            throw new \Exception('Gate exception #2: ' . $response->error->message, 2);
        }
        
        curl_close($curl);

        return $response;
    }
    
    /**
     * Prepare data for request.
     * 
     * @param array $data
     * @return string
     */
    protected function prepareData($data)
    {
        if(!is_array($data))
        {
            $data = [];
        }
        
        return http_build_query($data);
    }
    
    protected function getHeaders()
    {
        return ['Ocp-Apim-Subscription-Key: ' . $this->config->primaryKey                                                                                                                                                        ,];
    }

}