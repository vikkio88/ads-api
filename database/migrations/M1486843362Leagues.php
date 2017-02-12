<?php


use App\Lib\Slime\Interfaces\DatabaseHelpers\DbHelperInterface;
use Illuminate\Database\Capsule\Manager as Capsule;
use \Illuminate\Database\Schema\Blueprint as Blueprint;

class M1486843362Leagues implements DbHelperInterface
{

    public function run()
    {
        Capsule::schema()->dropIfExists('leagues');
        Capsule::schema()->create('leagues', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->tinyInteger('teams')->unsigned()->default(2);
            $table->timestamps();
        });
    }

}