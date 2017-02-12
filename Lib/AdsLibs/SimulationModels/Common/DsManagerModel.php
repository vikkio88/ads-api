<?php


namespace App\Lib\AdsLib\SimulationModels\Common;

use App\Lib\AdsLib\SimulationModels\Common\Interfaces\ActiveModel;


abstract class DsManagerModel implements ActiveModel
{
    public $id;

    abstract function toArray();

    public static function fromArray($array = [])
    {
        $class = get_called_class();
        $class = new $class();
        foreach ($array as $key => $value) {
            $class->$key = $value;
        }
        return $class;
    }
}