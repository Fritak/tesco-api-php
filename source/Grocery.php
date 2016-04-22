<?php

namespace fritak\TescoApiPhp;

/**
 * Basic config. 
 *
 * 
 * @package fritak\TescoApiPhp
 */
class Grocery
{
    /** @var fritak\TescoApiPhp\ProductSearch */
    public $products;
    
    public function __construct($result)
    {
        if(isset($result->products))
        {
            $this->products = new ProductSearch($result->products);
        }
    }
    
    public function getProducts()
    {
        if(isset($this->products->results))
        {
            return $this->products->results;
        }
    }
}

class ProductSearch
{
    /** @var fritak\TescoApiPhp\Totals Subscription key which provides access to this API. Found in your Profile. */
    public $totals;
    
    /** @var fritak\TescoApiPhp\Product */
    public $results;
    
    /** @var array  */
    public $suggestions;
    
    public function __construct($result)
    {
        if(isset($result->totals))
        {
            $this->totals = new Totals($result->totals);
        }
        
        if(isset($result->results))
        {
            $this->results = [];
            foreach($result->results AS $res)
            {
                $this->results[] = new Product($res);
            }
        }
        
        if(isset($result->suggestions))
        {
            $this->suggestions = $result->suggestions;
        }
    }
}

/**
 * @property-read int $all
 */
class Totals extends BaseObject 
{
    
}

/**
 * @property-read string $image
 * @property-read string $tpnb
 * @property-read string $ContentsMeasureType
 * @property-read string $name
 * @property-read int $UnitOfSale
 * @property-read array $description
 * @property-read float $AverageSellingUnitWeight
 * @property-read string $UnitQuantity
 * @property-read string $PromotionDescription
 * @property-read string $ContentsQuantity
 * @property-read float $price
 * @property-read float $unitprice
 * @property-read boolean $IsNew
 * @property-read boolean $IsSpecialOffer
 * 
 */
class Product extends BaseObject 
{
    
}