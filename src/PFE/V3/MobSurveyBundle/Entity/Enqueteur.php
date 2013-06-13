<?php

namespace PFE\V3\MobSurveyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Enqueteur
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PFE\V3\MobSurveyBundle\Entity\EnqueteurRepository")
 */
class Enqueteur extends TeamMember
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
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\ManyToMany(targetEntity="PFE\V3\MobSurveyBundle\Entity\Equipe" , mappedBy="enqueteurs" )
     * @ORM\JoinColumn(name="equipe", referencedColumnName="id", nullable=true)
     */
    protected $equipes;



    /**
     * @var string
     */
    protected $path;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $groups;



    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected  $geo;

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
        //$this->equipes = new \Doctrine\Common\Collections\ArrayCollection();
    }



    public function serialize(){
        return array(
            "id" => $this->getId(),
            "name" => $this->getUsername(),
            "email" => $this->getEmail(),
            "photo" => "web/".$this->getWebPath()
        );
    }


    /**
     * Set device_id
     *
     * @param string $deviceId
     * @return Enqueteur
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
     * Set path
     *
     * @param string $path
     * @return Enqueteur
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
     * Get groups
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGroups()
    {
        return $this->groups;
    }



    /**
     * Add geo
     *
     * @param \PFE\V3\MobSurveyBundle\Entity\GeoLocalisation $geo
     * @return Enqueteur
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