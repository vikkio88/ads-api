<?php

namespace App\Libs\AdsLib\SimulationModels;

use App\Lib\Helpers\Config;

class Module
{
    /**
     * @var
     */
    private $moduleCode;
    /**
     * @var
     */
    private $configuration;

    /**
     * @param $module
     */
    public function __construct($module)
    {
        $this->moduleCode = $module;
        $this->configuration = Config::get("modules.modules")[$module];
        if ($this->configuration == null) throw new \InvalidArgumentException("Not a valid Module supplied");
    }

    /**
     *
     */
    public function isOffensive()
    {
        return ($this->configuration["character"] === 1);
    }

    /**
     *
     */
    public function isBalanced()
    {
        return ($this->configuration["character"] === 2);
    }

    /**
     *
     */
    public function isDefensive()
    {
        return ($this->configuration["character"] === 4);
    }

    /**
     * @return string
     */
    function __toString()
    {
        return "" . $this->moduleCode;
    }


    /**
     * @param Team $team
     * @return bool
     */
    public function isApplicableToTeam(Team $team)
    {
        return $this->isApplicableToArray($team->playersPerRoleArray());
    }

    public function isApplicableToArray($playersForRole)
    {
        $roles = $this->getRoleNeeded();
        foreach ($roles as $role => $numbP) {
            if (!(isset($playersForRole[$role]) && $playersForRole[$role] >= $numbP)) {
                return false;
            }
        }
        return true;
    }


    /**
     * @param bool $complete
     * @return array
     */
    public function getRoleNeeded($complete = false)
    {
        $rolesNeeded = [];
        $roles = \App\Lib\Helpers\Config::get('modules.roles');
        $rolesKeys = array_keys($roles);
        foreach ($this->configuration["roles"] as $index => $playNum) {
            if ($playNum != 0 || $complete)
                $rolesNeeded[$rolesKeys[$index]] = $playNum;
        }

        return $rolesNeeded;
    }


}