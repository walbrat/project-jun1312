<?php

namespace core;

class Validator
{
    /**
     * @param mixed $value
     * @return bool
     */
    public function isEmpty(mixed $value): bool
    {
        if(empty($value)){
            return true;
        }
        return false;
    }
    
    /**
     * @param mixed $value
     * @param int $length
     * @return bool
     */
    public function matchingLength(mixed $value, int $length): bool
    {
        if(strlen($value)<=$length){
            return true;
        }return false;
    }
}
