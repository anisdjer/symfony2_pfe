<?php

namespace PFE\V3\MobSurveyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Choix
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PFE\V3\MobSurveyBundle\Entity\ChoixRepository")
 */
class Choix
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
     * @var string
     *
     * @ORM\Column(name="ch_type", type="string", length=255)
     */
    private $chType;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\ManyToMany(targetEntity="PFE\V3\MobSurveyBundle\Entity\Reponse",   inversedBy="choix")
     */
    private $reponse;

    /**
     * @ORM\ManyToOne(targetEntity="PFE\V3\MobSurveyBundle\Entity\Question")
     */
    private $attachedQuestion;

    /**
     * @ORM\ManyToOne(targetEntity="PFE\V3\MobSurveyBundle\Entity\Question" , cascade={"persist"})
     * @ORM\JoinColumn(name="question", referencedColumnName="id", nullable=false)
     */
    private $question;


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
     * @return Choix
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
     * Set chType
     *
     * @param string $chType
     * @return Choix
     */
    public function setChType($chType)
    {
        $this->chType = $chType;
    
        return $this;
    }

    /**
     * Get chType
     *
     * @return string 
     */
    public function getChType()
    {
        return $this->chType;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->reponse = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add reponse
     *
     * @param \PFE\V3\MobSurveyBundle\Entity\Reponse $reponse
     * @return Choix
     */
    public function addReponse(\PFE\V3\MobSurveyBundle\Entity\Reponse $reponse)
    {
        $this->reponse[] = $reponse;
    
        return $this;
    }

    /**
     * Remove reponse
     *
     * @param \PFE\V3\MobSurveyBundle\Entity\Reponse $reponse
     */
    public function removeReponse(\PFE\V3\MobSurveyBundle\Entity\Reponse $reponse)
    {
        $this->reponse->removeElement($reponse);
    }

    /**
     * Get reponse
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getReponse()
    {
        return $this->reponse;
    }

    /**
     * Set attachedQuestion
     *
     * @param \PFE\V3\MobSurveyBundle\Entity\Question $attachedQuestion
     * @return Choix
     */
    public function setAttachedQuestion(\PFE\V3\MobSurveyBundle\Entity\Question $attachedQuestion = null)
    {
        $this->attachedQuestion = $attachedQuestion;
    
        return $this;
    }

    /**
     * Get attachedQuestion
     *
     * @return \PFE\V3\MobSurveyBundle\Entity\Question 
     */
    public function getAttachedQuestion()
    {
        return $this->attachedQuestion;
    }

    /**
     * Set question
     *
     * @param \PFE\V3\MobSurveyBundle\Entity\Question $question
     * @return Choix
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
}