<?php

require '../vendor/autoload.php';

use App\Lib\Helpers\Config;
use Illuminate\Database\Capsule\Manager as Capsule;
use Mashtru\JobManager;
use Mashtru\Libs\Helpers\DBConfig;
use Mashtru\Libs\Helpers\RunnerConfig;

$dbConfig = Capsule::connection()->getConfig(null);

$jobs = new JobManager(
    new DBConfig(
        $dbConfig['host'],
        $dbConfig['database'],
        $dbConfig['username'],
        $dbConfig['password']
    ),
    new RunnerConfig(
        Config::get('cron.namespaces', '../'),
        true
    )
);


$jobs->fire();

echo "<pre>";
echo <<<EOF
  /\/\   __ _ ___| |__ | |_ _ __ _   _( )__    __| | ___  _ __   ___ 
 /    \ / _` / __| '_ \| __| '__| | | |/ __|  / _` |/ _ \| '_ \ / _ \
/ /\/\ \ (_| \__ \ | | | |_| |  | |_| |\__ \ | (_| | (_) | | | |  __/
\/    \/\__,_|___/_| |_|\__|_|   \__,_||___/  \__,_|\___/|_| |_|\___|
EOF;

echo "</pre>";




