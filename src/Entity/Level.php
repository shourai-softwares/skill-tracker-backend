<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity()
 */
class Level
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $level;

    /**
     * @ORM\OneToOne(targetEntity="Skill", inversedBy="level")
     */
    private $skill;

    public function setLevel(int $level): Level
    {
        $this->level = $level;
        return $this;
    }

    public function increaseLevelIn(int $increase): Level
    {
        $this->level += $increase;
        return $this;
    }

    public function setSkill(Skill $skill): Level
    {
        $this->skill = $skill;
        return $this;
    }
}

