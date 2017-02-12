<?php


use App\Lib\Slime\Interfaces\DatabaseHelpers\DbHelperInterface;
use Illuminate\Database\Capsule\Manager as Capsule;
use \Illuminate\Database\Schema\Blueprint as Blueprint;

class M1486843381LeagueTeams implements DbHelperInterface
{

    public function run()
    {
        Capsule::schema()->dropIfExists('league_teams');
        Capsule::schema()->create('league_teams', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('league_id');
            $table->integer('team_id');
            $table->tinyInteger('points')->unsigned()->default(0);
            $table->tinyInteger('played')->unsigned()->default(0);
            $table->tinyInteger('won')->unsigned()->default(0);
            $table->tinyInteger('draw')->unsigned()->default(0);
            $table->tinyInteger('lost')->unsigned()->default(0);
            $table->timestamps();
        });
    }

}