<?php

/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 8/6/16
 * Time: 4:08 PM
 */
class Validation
{
    static function is_num($val){
        if(is_numeric($val)){
            return true;
        }
    }

    static function isValidInput($val){
        $pattern = "/^[a-zA-Z0-9]{6,32}$/";

        if(preg_match($pattern,$val)){
            return true;
        }else{
            return false;
        }
    }
}