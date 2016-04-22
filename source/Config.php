<?php

namespace fritak\TescoApiPhp;

/**
 * Basic config.
 *
 * 
 * @package fritak\TescoApiPhp
 */
class Config
{
    /** @var string Subscription key which provides access to this API. Found in your Profile. */
    public $primaryKey;
    
    /** @var string  */
    public $secondaryKey;
    
    public function __construct($primaryKey, $secondaryKey)
    {
        $this->primaryKey   = $primaryKey;
        $this->secondaryKey = $secondaryKey;
    }
}