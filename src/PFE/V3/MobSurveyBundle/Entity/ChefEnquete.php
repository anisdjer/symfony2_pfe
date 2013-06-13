<?php

namespace PFE\V3\MobSurveyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ChefEnquete
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PFE\V3\MobSurveyBundle\Entity\ChefEnqueteRepository")
 */
class ChefEnquete extends Mobile
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected  $id;


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
        $this->groups = new \Doctrine\Common\Collections\ArrayCollection();
    }





    /**
     * @var string
     */
    protected  $path;


    /**
     * Set path
     *
     * @param string $path
     * @return ChefEnquete
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


    /**
     * Get groups
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGroups()
    {
        return $this->groups;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected  $groups;

    /**
     * @var string
     */
    protected  $device_id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected  $geo;


    /**
     * Set device_id
     *
     * @param string $deviceId
     * @return ChefEnquete
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
     * @return ChefEnquete
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