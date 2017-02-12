<?php


namespace App\Lib\AdsLib\SimulationModels\Common\Interfaces;


interface ActiveModel
{
    public function toArray();

    public static function fromArray();
}