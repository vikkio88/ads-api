<?php


use App\Lib\Slime\Interfaces\DatabaseHelpers\DbHelperInterface;
use Illuminate\Database\Capsule\Manager as Capsule;
use \Illuminate\Database\Schema\Blueprint as Blueprint;

class M1486843339Coaches implements DbHelperInterface
{

    public function run()
    {
        Capsule::schema()->dropIfExists('coaches');
        Capsule::schema()->create('coaches', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('surname');
            $table->tinyInteger('age');
            $table->string('nationality', 2);
            $table->float('skillAvg');
            $table->float('wageReq');
            $table->string('favouriteModule', 10);
            $table->integer('team_id')->nullable();
            $table->timestamps();
        });
    }

}