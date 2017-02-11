<?php


use App\Lib\Slime\Interfaces\DatabaseHelpers\DbHelperInterface;
use Illuminate\Database\Capsule\Manager as Capsule; 
use \Illuminate\Database\Schema\Blueprint as Blueprint;

class M1486843413Teams implements DbHelperInterface {

        public function run()
        {
        $tableName = 'table_name';
        Capsule::schema()->dropIfExists($tableName);
        Capsule::schema()->create($tableName, function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
        }
        
}