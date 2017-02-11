<?php


namespace App\Libs\AdsLib;

use App\Lib\DsManager\Models\Coach;
use App\Lib\DsManager\Models\Player;
use App\Lib\DsManager\Models\Team;
use App\Lib\Helpers\Config;

/**
 * Class RandomFiller
 * @package App\Lib\DsManager\Helpers
 */
class RandomFiller
{
    /**
     * @var \Faker\Generator
     */
    protected $faker;

    /**
     * @var string
     */
    protected $locale;


    /**
     * RandomFiller constructor.
     * @param string $locale
     */
    public function __construct($locale = "it_IT")
    {
        $this->locale = $locale;
        $this->faker = \Faker\Factory::create($locale);
    }

    /**
     * @return string
     */
    public function getTeamName()
    {
        return $this->faker->city;
    }


    /**
     * @param null $forcedRole
     * @param null $locale
     * @return Player
     */
    public function getPlayer($forcedRole = null, $locale = null)
    {
        $this->setFaker($locale);
        $player = new Player;
        $player->name = $this->faker->firstNameMale;
        $player->surname = $this->faker->lastName;
        $player->role = $forcedRole == null ? $this->getRole() : $forcedRole;
        $player->nationality = $this->nationalityFromLocale($this->locale);
        $player->age = rand(16, 38);
        $player->skillAvg = rand(40, 100);

        return $player;
    }


    /**
     * @param null $locale
     * @return Coach
     */
    public function getCoach($locale = null)
    {
        $this->setFaker($locale);
        $coach = new Coach;
        $coach->name = $this->faker->firstNameMale;
        $coach->surname = $this->faker->lastName;
        $coach->favouriteModule = $this->getModule();
        $coach->nationality = $this->nationalityFromLocale($this->locale);
        $coach->age = rand(33, 68);
        $coach->skillAvg = rand(40, 100);

        return $coach;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        $roles = array_keys(Config::get('modules.roles'));
        shuffle($roles);
        return $roles[0];
    }

    /**
     * @return mixed
     */
    public function getModule()
    {
        $modules = array_keys(Config::get('modules.modules'));
        shuffle($modules);
        return $modules[0];
    }


    /**
     * @param null $locale
     * @return Team
     */
    public function getTeam($locale = null)
    {
        $rosterConf = Config::get('generic.rosters');
        $numberOfPlayers = rand($rosterConf['min'], $rosterConf['max']);
        $this->setFaker($locale);
        $team = new Team;
        $team->name = $this->getTeamName();
        $team->nationality = $this->nationalityFromLocale($this->locale);
        $players = [];
        for ($i = 0; $i < $numberOfPlayers; $i++) {
            $players[] = $this->getPlayer();
        }
        //Adding some forced role
        $players[] = $this->getPlayer("GK", $this->getLocale());
        $players[] = $this->getPlayer("CD", $this->getLocale());
        $players[] = $this->getPlayer("CD", $this->getLocale());
        $players[] = $this->getPlayer("CM", $this->getLocale());
        $players[] = $this->getPlayer("CM", $this->getLocale());
        $players[] = $this->getPlayer("CS", $this->getLocale());
        //

        $team->roster = $players;
        //setting random Nationality Coach (20%)
        $coachNationality = Randomizer::boolOnPercentage(20) ? $this->getLocale() : null;
        $team->coach = $this->getCoach($coachNationality);

        return $team;
    }


    /**
     * @return mixed
     */
    public function getLocale()
    {
        $locales = (Config::get('generic.localesSmall'));
        shuffle($locales);
        return $locales[0];
    }

    /**
     * @param $locale
     * @return mixed
     */
    private function nationalityFromLocale($locale)
    {
        return preg_replace("/.._/", '', $locale);
    }

    /**
     * @param $locale
     */
    private function setFaker($locale)
    {
        if ($locale !== null) {
            $this->faker = \Faker\Factory::create($locale);
            $this->locale = $locale;
        }
    }

}