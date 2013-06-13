<?php

namespace PFE\V3\MobSurveyBundle\Entity;

use FOS\UserBundle\Entity\Group as BaseGroup;

use Doctrine\ORM\Mapping as ORM;

/**
 * Groupe
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Groupe extends BaseGroup
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->name;
    }
}