<?php

namespace PFE\V3\MobSurveyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Superviseur
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PFE\V3\MobSurveyBundle\Entity\SuperviseurRepository")
 */
class Superviseur extends TeamMember
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
     * @ORM\OneToMany(targetEntity="PFE\V3\MobSurveyBundle\Entity\Equipe" , mappedBy="superviseur")
     */
    protected $equipes;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->groups = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * @var string
     */
    protected $path;


    /**
     * Set path
     *
     * @param string $path
     * @return Superviseur
     */
    public function setPath($path)
    {
        $this->path = $path;
    
        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $groups;


    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected  $geo;


    /**
     * Set device_id
     *
     * @param string $deviceId
     * @return Superviseur
     */
    public function setDeviceId($deviceId)
    {
        $this->device_id = $deviceId;
    
        return $this;
    }

    /**
     * Get device_id
     *
     * @return string 
     */
    public function getDeviceId()
    {
        return $this->device_id;
    }

    /**
     * Add geo
     *
     * @param \PFE\V3\MobSurveyBundle\Entity\GeoLocalisation $geo
     * @return Superviseur
     */
    public function addGeo(\PFE\V3\MobSurveyBundle\Entity\GeoLocalisation $geo)
    {
        $this->geo[] = $geo;
    
        return $this;
    }

    /**
     * Remove geo
     *
     * @param \PFE\V3\MobSurveyBundle\Entity\GeoLocalisation $geo
     */
    public function removeGeo(\PFE\V3\MobSurveyBundle\Entity\GeoLocalisation $geo)
    {
        $this->geo->removeElement($geo);
    }

    /**
     * Get geo
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGeo()
    {
        return $this->geo;
    }


}