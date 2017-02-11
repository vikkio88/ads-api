<?php


namespace App\Libs\AdsLib\SimulationModels\Common\Interfaces;


interface ActiveModel
{
    public function toArray();

    public static function fromArray();
}