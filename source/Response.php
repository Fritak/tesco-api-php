<?php

namespace fritak\TescoApiPhp;


/**
 * Handling response.
 * 
 * 
 * @package fritak\TescoApiPhp
 */
class Response extends BaseObject
{

    /**
     * 
     *
     * @param $response Response from api.
     */
    public function __construct($response)
    { 
        $decoded = is_object($response)? $response : json_decode($response);

        if(empty($decoded))
        {
            return NULL;
        }
        
        foreach($decoded AS $key => $val)
        { 
            if($key == 'ghs')
            {
                $this->data[$key] = new Grocery($val);
            }
            else
            {
                $this->data[$key] = is_object($val)? new Response($val) : $val;
            }
            
        }
    }
    
    /**
     * 
     * @return fritak\TescoApiPhp\Grocery 
     */
    public function getGrocery()
    {
        if(isset($this->uk->ghs))
        {
            return $this->uk->ghs;
        }
    }
    
    /**
     * 
     * @return array Array of fritak\TescoApiPhp\Product 
     */
    public function getProducts()
    {
        if(isset($this->uk->ghs) && NULL !== $this->uk->ghs->getProducts())
        {
            return $this->uk->ghs->getProducts();
        }
    }
}