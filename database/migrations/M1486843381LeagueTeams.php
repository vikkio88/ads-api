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
            $table->unsignedTinyInteger('points')->default(0);
            $table->unsignedTinyInteger('played')->default(0);
            $table->unsignedTinyInteger('won')->default(0);
            $table->unsignedTinyInteger('draw')->default(0);
            $table->unsignedTinyInteger('lost')->default(0);
            $table->timestamps();
        });
    }

}