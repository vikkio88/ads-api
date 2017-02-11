<?php


use App\Lib\Slime\Interfaces\DatabaseHelpers\DbHelperInterface;
use Illuminate\Database\Capsule\Manager as Capsule;
use \Illuminate\Database\Schema\Blueprint as Blueprint;

class M1486843413Teams implements DbHelperInterface
{

    public function run()
    {
        Capsule::schema()->dropIfExists('teams');
        Capsule::schema()->create('teams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('nationality', 2);
            $table->timestamps();
        });
    }

}