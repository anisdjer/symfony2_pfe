<?php

namespace PFE\V3\MobSurveyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GeoLocalisation
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PFE\V3\MobSurveyBundle\Entity\GeoLocalisationRepository")
 */
class GeoLocalisation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="latitude", type="float")
     */
    private $latitude;

    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float")
     */
    private $longitude;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_localisation", type="date")
     */
    private $dateLocalisation;


    /**
     * @ORM\ManyToOne(targetEntity="PFE\V3\MobSurveyBundle\Entity\Utilisateur" )
     * @ORM\JoinColumn(name="createur", referencedColumnName="id", nullable=false)
     */
    private $user;

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
     * Set latitude
     *
     * @param float $latitude
     * @return GeoLocalisation
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    
        return $this;
    }

    /**
     * Get latitude
     *
     * @return float 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     * @return GeoLocalisation
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    
        return $this;
    }

    /**
     * Get longitude
     *
     * @return float 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set dateLocalisation
     *
     * @param \DateTime $dateLocalisation
     * @return GeoLocalisation
     */
    public function setDateLocalisation($dateLocalisation)
    {
        $this->dateLocalisation = $dateLocalisation;
    
        return $this;
    }

    /**
     * Get dateLocalisation
     *
     * @return \DateTime 
     */
    public function getDateLocalisation()
    {
        return $this->dateLocalisation;
    }

    /**
     * Set user
     *
     * @param \PFE\V3\MobSurveyBundle\Entity\Utilisateur $user
     * @return GeoLocalisation
     */
    public function setUser(\PFE\V3\MobSurveyBundle\Entity\Utilisateur $user)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \PFE\V3\MobSurveyBundle\Entity\Utilisateur 
     */
    public function getUser()
    {
        return $this->user;
    }
}