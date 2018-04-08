<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity()
 */
class Skill
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="Skill", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     * @JMS\Exclude()
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="Skill", mappedBy="parent")
     * @JMS\Exclude()
     */
    private $children;

    /**
     * @ORM\OneToMany(targetEntity="Exercise", mappedBy="skill")
     * @JMS\Exclude()
     */
    private $exercises;

    /**
     * @ORM\OneToOne(targetEntity="Level", mappedBy="skill")
     * @JMS\Exclude()
     */
    private $level;

    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
        $this->exercises = new \Doctrine\Common\Collections\ArrayCollection();
    }


    public function setName(string $name): Skill
    {
        $this->name = $name;
        return $this;
    }

    public function setParent(Skill $parent): Skill
    {
        $this->parent = $parent;
        return $this;
    }

    public function setLevel(Level $level): Skill
    {
        $this->level = $level;
        return $this;
    }

    public function getLevel(): Level
    {
        return $this->level;
    }

    public function getChildren(): Array
    {
        return $this->children->toArray();
    }
}
