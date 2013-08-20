<?php

namespace PFE\V3\MobSurveyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Repondant
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PFE\V3\MobSurveyBundle\Entity\RepondantRepository")
 */
class Repondant
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var integer
     *
     * @ORM\Column(name="age", type="integer" , nullable=true)
     */
    private $age;

    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", length=255 , nullable=true)
     */
    private $region;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", length=1)
     */
    private $sexe;

    /**
     * @var long
     *
     * @ORM\Column(name="date_reponse", type="bigint")
     */
    private $answertime;

    /**
     * @ORM\OneToMany(targetEntity="PFE\V3\MobSurveyBundle\Entity\FicheReponse", mappedBy="repondant")
     * @ORM\JoinColumn(name="fiche", referencedColumnName="id", nullable=false)
     */
    private $ficheReponse;




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
     * Set nom
     *
     * @param string $nom
     * @return Repondant
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    
        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set age
     *
     * @param integer $age
     * @return Repondant
     */
    public function setAge($age)
    {
        $this->age = $age;
    
        return $this;
    }

    /**
     * Get age
     *
     * @return integer 
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set region
     *
     * @param string $region
     * @return Repondant
     */
    public function setRegion($region)
    {
        $this->region = $region;
    
        return $this;
    }

    /**
     * Get region
     *
     * @return string 
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     * @return Repondant
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;
    
        return $this;
    }

    /**
     * Get sexe
     *
     * @return string 
     */
    public function getSexe()
    {
        return $this->sexe;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ficheReponse = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add ficheReponse
     *
     * @param \PFE\V3\MobSurveyBundle\Entity\FicheReponse $ficheReponse
     * @return Repondant
     */
    public function addFicheReponse(\PFE\V3\MobSurveyBundle\Entity\FicheReponse $ficheReponse)
    {
        $this->ficheReponse[] = $ficheReponse;
    
        return $this;
    }

    /**
     * Remove ficheReponse
     *
     * @param \PFE\V3\MobSurveyBundle\Entity\FicheReponse $ficheReponse
     */
    public function removeFicheReponse(\PFE\V3\MobSurveyBundle\Entity\FicheReponse $ficheReponse)
    {
        $this->ficheReponse->removeElement($ficheReponse);
    }

    /**
     * Get ficheReponse
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFicheReponse()
    {
        return $this->ficheReponse;
    }

    /**
     * Set answertime
     *
     * @param  $answertime
     * @return Repondant
     */
    public function setAnswertime($answertime)
    {
        $this->answertime = $answertime;
    
        return $this;
    }

    /**
     * Get answertime
     *
     *  
     */
    public function getAnswertime()
    {
        return $this->answertime;
    }
}