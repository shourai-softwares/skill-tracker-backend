<?php
namespace App\Output;

use App\Entity\Skill;

class SkillTree
{
    private $root;
    private $children = [];

    public function __construct(Skill $parentSkill)
    {
        $this->root = $parentSkill;
        foreach($parentSkill->getChildren() as $child)
            $this->children[] = new SkillTree($child);
    }
}
