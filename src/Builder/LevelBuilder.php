<?php
namespace App\Builder;

use App\Entity\Level;
use App\Entity\Skill;

class LevelBuilder implements BuilderInterface
{
    private $level;
    private $skill;

    public function build(): Level
    {
        $newLevel = (new Level())
            ->setSkill($this->skill)
            ->setLevel(0);

        return $newLevel;
    }

    public function setLevel(int $level): LevelBuilder
    {
        $this->level = $level;
        return $this;
    }

    public function setSkill(Skill $skill): LevelBuilder
    {
        $this->skill = $skill;
        return $this;
    }
}
