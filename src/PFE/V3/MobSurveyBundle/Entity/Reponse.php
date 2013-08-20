<?php

namespace PFE\V3\MobSurveyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reponse
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PFE\V3\MobSurveyBundle\Entity\ReponseRepository")
 */
class Reponse
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
     * @ORM\Column(name="valeur", type="string", length=255)
     */
    private $valeur;

    /**
     *
     * @ORM\ManyToOne(targetEntity="PFE\V3\MobSurveyBundle\Entity\Question",  inversedBy="reponse")
     * @ORM\JoinColumn(name="question", referencedColumnName="id", nullable=false)
     */
    private $question;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="PFE\V3\MobSurveyBundle\Entity\Choix",   mappedBy="reponse")
     */
    private $choix;

    /**
     * @ORM\ManyToOne(targetEntity="PFE\V3\MobSurveyBundle\Entity\FicheReponse")
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
     * Set valeur
     *
     * @param string $valeur
     * @return Reponse
     */
    public function setValeur($valeur)
    {
        $this->valeur = $valeur;
    
        return $this;
    }

    /**
     * Get valeur
     *
     * @return string 
     */
    public function getValeur()
    {
        return $this->valeur;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->choix = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set question
     *
     * @param \PFE\V3\MobSurveyBundle\Entity\Question $question
     * @return Reponse
     */
    public function setQuestion(\PFE\V3\MobSurveyBundle\Entity\Question $question)
    {
        $this->question = $question;
    
        return $this;
    }

    /**
     * Get question
     *
     * @return \PFE\V3\MobSurveyBundle\Entity\Question 
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Add choix
     *
     * @param \PFE\V3\MobSurveyBundle\Entity\Choix $choix
     * @return Reponse
     */
    public function addChoix(\PFE\V3\MobSurveyBundle\Entity\Choix $choix)
    {
        $this->choix[] = $choix;
    
        return $this;
    }

    /**
     * Remove choix
     *
     * @param \PFE\V3\MobSurveyBundle\Entity\Choix $choix
     */
    public function removeChoix(\PFE\V3\MobSurveyBundle\Entity\Choix $choix)
    {
        $this->choix->removeElement($choix);
    }

    /**
     * Get choix
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChoix()
    {
        return $this->choix;
    }

    /**
     * Get choix
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function setChoix(\Doctrine\Common\Collections\Collection $choices)
    {
        $this->choix = $choices;
    }

    /**
     * Set ficheReponse
     *
     * @param \PFE\V3\MobSurveyBundle\Entity\FicheReponse $ficheReponse
     * @return Reponse
     */
    public function setFicheReponse(\PFE\V3\MobSurveyBundle\Entity\FicheReponse $ficheReponse)
    {
        $this->ficheReponse = $ficheReponse;
    
        return $this;
    }

    /**
     * Get ficheReponse
     *
     * @return \PFE\V3\MobSurveyBundle\Entity\FicheReponse 
     */
    public function getFicheReponse()
    {
        return $this->ficheReponse;
    }
}