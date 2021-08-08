<?php


namespace Loecos\Funpay237\Classes\Enums;


abstract class PaymentMode extends Enum
{
    const OM = "OM";
    const EUM = "EUM";
    const  MOMO = "MOMO";

}
abstract class Enum {
    static function getKeys(){
        $class = new ReflectionClass(get_called_class());
        return array_keys($class->getConstants());
    }
}
