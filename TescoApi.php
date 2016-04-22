<?php

namespace fritak;

use fritak\TescoApiPhp\Gate;
use fritak\TescoApiPhp\Config;

/**
 * Class for tescolabs API. 
 *
 * @package fritak\TescoApiPhp
 * @see https://devportal.tescolabs.com/docs/services/
 */
class TescoApi
{
    /** @var fritak\TescoApiPhp\Config Config for application */
    public $config;

    /** @var fritak\TescoApiPhp\Gate Gate for API. */
    protected $gate = NULL;


    public function __construct($config)
    { 
        $this->loadConfig($config);
    }

    /**
     * You can load another config  later on.
     * 
     * @param array $config
     */
    public function loadConfig(Config $config)
    {
        $this->config = $config;
        $this->gate = new Gate($this->config);
    }
    
    /**
     * Returns matching products based on search terms provided.
     * 
     * @param string $query The search term to query by.
     * @param int $limit Limits results to this number.
     * @param int $offset Starts the results at this offset number.
     */
    public function findGroceryProduct($query, $limit = 10, $offset = 0)
    {
        return $this->gate->request(Gate::URL_GROCERY_PRODUCTS, ['query' => $query, 'offset' => $offset, 'limit' => $limit]);
    }
    
}