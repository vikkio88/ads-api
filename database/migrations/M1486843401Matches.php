<?php


use App\Lib\Slime\Interfaces\DatabaseHelpers\DbHelperInterface;
use Illuminate\Database\Capsule\Manager as Capsule;
use \Illuminate\Database\Schema\Blueprint as Blueprint;

class M1486843401Matches implements DbHelperInterface
{

    public function run()
    {
        Capsule::schema()->dropIfExists('matches');
        Capsule::schema()->create('matches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('league_round_id')->nullable();
            $table->integer('home_team_id');
            $table->integer('goal_home')->default(0);
            $table->integer('away_team_id');
            $table->integer('goal_away')->default(0);
            $table->boolean('is_draw')->default(false);
            $table->integer('winner_id')->default(null);
            $table->integer('loser_id')->default(null);
            $table->boolean('simulated')->default(false);
            $table->date('date');
            $table->timestamps();
        });
    }

}