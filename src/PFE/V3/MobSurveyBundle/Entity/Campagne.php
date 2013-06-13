<?php

namespace PFE\V3\MobSurveyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Campagne
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PFE\V3\MobSurveyBundle\Entity\CampagneRepository")
 */
class Campagne
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
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="date")
     */
    private $dateCreation;


    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="PFE\V3\MobSurveyBundle\Entity\Enquete", orphanRemoval=true, mappedBy="campagne")
     */
    private $enquetes;

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
     * Set titre
     *
     * @param string $titre
     * @return Campagne
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    
        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return Campagne
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    
        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime 
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    public function __toString(){

        return $this->getTitre();
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Campagne
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->enquetes = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add enquetes
     *
     * @param \PFE\V3\MobSurveyBundle\Entity\Enquete $enquetes
     * @return Campagne
     */
    public function addEnquete(\PFE\V3\MobSurveyBundle\Entity\Enquete $enquetes)
    {
        $this->enquetes[] = $enquetes;
    
        return $this;
    }

    /**
     * Remove enquetes
     *
     * @param \PFE\V3\MobSurveyBundle\Entity\Enquete $enquetes
     */
    public function removeEnquete(\PFE\V3\MobSurveyBundle\Entity\Enquete $enquetes)
    {
        $this->enquetes->removeElement($enquetes);
    }

    /**
     * Get enquetes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEnquetes()
    {
        return $this->enquetes;
    }
}