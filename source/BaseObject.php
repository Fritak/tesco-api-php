<?php

namespace fritak\TescoApiPhp;

/**
 * Base object.
 *
 * 
 * @package fritak\TescoApiPhp
 */
abstract class BaseObject
{

    /** @var array */
    protected $data = [];
    
    /**
     * Basic config.
     *
     * @param $array Config.
     */
    public function __construct($array)
    {
        foreach($array AS $key => $val)
        {
            $this->data[$key] = $val;
        }
    }
    
    public function &__get($key)
    {
        if(empty($this->data[$key]))
        {
            throw new \Exception('Key "' . $key . '" is missing in "' . (get_class($this)) . '".', 1);
        }

        return $this->data[$key];
    }
    
    public function __isset($name)
    {
        return isset($this->data[$name]);
    }
    
    public function getDataForCall()
    {
        $result = [];
        foreach($this->data as $key => $item)
        {
            $result[$key] = $item;
        }
        
        return $result;
    }
}