<?php
namespace App\Builder;

use App\Entity\Skill;

class SkillBuilder implements BuilderInterface
{
    private $name = null;
    private $parent = null;
    private $level = null;

    public function build(): Skill
    {
        $newSkill = (new Skill())
            ->setName($this->name);

        if(!is_null($this->parent))
            $newSkill->setParent($this->parent);


        $level = (new LevelBuilder())
            ->setSkill($newSkill)
            ->build();

        $newSkill->setLevel($level);

        return $newSkill;
    }

    public function setName(string $name): SkillBuilder
    {
        $this->name = $name;
        return $this;
    }

    public function setParent(Skill $parent): SkillBuilder
    {
        $this->parent = $parent;
        return $this;
    }
}
