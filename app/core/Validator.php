<?php

namespace core;

use models\Page;

class Validator
{
    public $validateArray = array('title', 'content', 'btn_name');
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

    public function validateLength(mixed $key,mixed $value): bool
    {
        if ($key == 'title' && mb_strlen($value) >= LENGTH_TITLE
            || $key == 'content' && mb_strlen($value) >= LENGTH_CONTENT
            || $key == 'btn_name' && mb_strlen($value) >= LENGTH_BTN_NAME){
            return 'true';
        }
         else {
            return false;
        }
    }

}
