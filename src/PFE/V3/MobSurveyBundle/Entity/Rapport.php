<?php

namespace PFE\V3\MobSurveyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rapport
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PFE\V3\MobSurveyBundle\Entity\RapportRepository")
 */
class Rapport
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
     * @ORM\Column(name="texte", type="text")
     */
    private $texte;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="date")
     */
    private $dateCreation;

    /**
     * @ORM\ManyToOne(targetEntity="PFE\V3\MobSurveyBundle\Entity\Utilisateur" )
     * @ORM\JoinColumn(name="createur", referencedColumnName="id", nullable=false)
     */
    private $createur;

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
     * Set texte
     *
     * @param string $texte
     * @return Rapport
     */
    public function setTexte($texte)
    {
        $this->texte = $texte;
    
        return $this;
    }

    /**
     * Get texte
     *
     * @return string 
     */
    public function getTexte()
    {
        return $this->texte;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return Rapport
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

    /**
     * Set createur
     *
     * @param \PFE\V3\MobSurveyBundle\Entity\Utilisateur $createur
     * @return Rapport
     */
    public function setCreateur(\PFE\V3\MobSurveyBundle\Entity\Utilisateur $createur)
    {
        $this->createur = $createur;
    
        return $this;
    }

    /**
     * Get createur
     *
     * @return \PFE\V3\MobSurveyBundle\Entity\Utilisateur 
     */
    public function getCreateur()
    {
        return $this->createur;
    }
}