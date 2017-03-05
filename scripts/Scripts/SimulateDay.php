<?php


namespace App\Scripts;


use App\Lib\Helpers\PodcastFeedImporter;
use App\Lib\Helpers\RadioFeedGateway;
use App\Lib\Parsers\Exceptions\InvalidFeedFormatException;
use App\Models\Podcasts\Podcast;
use App\Models\Podcasts\RadioShow;
use Mashtru\Libs\Interfaces\Job;

class SimulateDay implements Job
{

    public function fire(array $parameters = [])
    {

    }

    public function getName()
    {
        return "simulateDay";
    }
}