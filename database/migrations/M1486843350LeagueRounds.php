<?php


use App\Lib\Slime\Interfaces\DatabaseHelpers\DbHelperInterface;
use Illuminate\Database\Capsule\Manager as Capsule;
use \Illuminate\Database\Schema\Blueprint as Blueprint;

class M1486843350LeagueRounds implements DbHelperInterface
{

    public function run()
    {
        Capsule::schema()->dropIfExists('league_rounds');
        Capsule::schema()->create('league_rounds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('league_id');
            $table->boolean('simulated')->default(false);
            $table->integer('day')->default(0);
            $table->timestamps();
        });
    }

}