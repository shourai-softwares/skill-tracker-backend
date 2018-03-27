<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity()
 */
class Exercise
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Skill", inversedBy="exercises")
     * @JMS\Exclude()
     */
    private $skill;

    /**
     * @ORM\Column(type="integer")
     */
    private $intensity;

    public function setSkill(Skill $skill): Exercise
    {
        $this->skill = $skill;
        return $this;
    }

    public function setIntensity(int $intensity): Exercise
    {
        $this->intensity = $intensity;
        return $this;
    }
}
