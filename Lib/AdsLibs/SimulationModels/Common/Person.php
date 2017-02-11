<?php


namespace App\Libs\AdsLib\SimulationModels\Common;


use App\Libs\AdsLib\Randomizer;

abstract class Person extends DsManagerModel
{
    public $name;
    public $surname;
    public $nationality;
    public $age;
    public $skillAvg;
    public $wageReq;

    public function toArray()
    {
        $result = [];
        $result['name'] = $this->name;
        $result['surname'] = $this->surname;
        $result['nationality'] = $this->nationality;
        $result['age'] = $this->age;
        $result['skillAvg'] = $this->skillAvg;
        return $result;
    }

    protected function spareChange()
    {
        return Randomizer::boolOnPercentage(50)
            ?
            (rand(1, 5) / 10.0)
            :
            (-1) * (rand(1, 5) / 10.0);
    }
}