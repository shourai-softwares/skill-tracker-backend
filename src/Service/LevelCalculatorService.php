<?php
namespace App\Service;

use App\Entity\Exercise;

class LevelCalculatorService
{
    public function updateLevelsWith(Exercise $exercise): void
    {
        $baseSkill = $exercise->getSkill();
        $level = $baseSkill->getLevel();
        $level->increaseLevelIn($exercise->getIntensity());
    }
}
