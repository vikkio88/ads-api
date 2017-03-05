<?php
require '../vendor/autoload.php';

use App\Lib\Helpers\Config;
use Carbon\Carbon;
use Illuminate\Database\Capsule\Manager as Capsule;
use Mashtru\JobManager;
use Mashtru\Libs\Factories\JobEntityFactory;
use Mashtru\Libs\Helpers\DBConfig;
use Mashtru\Models\JobEntity;


$jobsConfig = Config::get('cron.jobs', '../');
$dbConfig = Capsule::connection()->getConfig(null);


$jobDb = JobEntityFactory::getInstance(
    new DBConfig(
        $dbConfig['host'],
        $dbConfig['database'],
        $dbConfig['username'],
        $dbConfig['password']
    ),
    JobManager::TABLE_NAME
);

echo "<pre>Creating db structure" . PHP_EOL . PHP_EOL;
$jobDb->uninstall();
$jobDb->install();

echo "Adding configured jobs" . PHP_EOL;
foreach ($jobsConfig as $job) {
    $job['fire_time'] = Carbon::now()->format(JobEntity::TIME_FORMAT);
    $jobDb->create($job);
}

echo <<<EOF
                  _     _              _      _           _        _ _          _ 
  /\/\   __ _ ___| |__ | |_ _ __ _   _( )__  (_)_ __  ___| |_ __ _| | | ___  __| |
 /    \ / _` / __| '_ \| __| '__| | | |/ __| | | '_ \/ __| __/ _` | | |/ _ \/ _` |
/ /\/\ \ (_| \__ \ | | | |_| |  | |_| |\__ \ | | | | \__ \ || (_| | | |  __/ (_| |
\/    \/\__,_|___/_| |_|\__|_|   \__,_||___/ |_|_| |_|___/\__\__,_|_|_|\___|\__,_|
                                                                                  
EOF;

echo "</pre>";
unlink(__FILE__);
