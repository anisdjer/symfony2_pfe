<?php

namespace PFE\V3\MobSurveyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Questionnaire
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PFE\V3\MobSurveyBundle\Entity\QuestionnaireRepository")
 */
class Questionnaire
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
     * @var \Date
     *
     * @ORM\Column(name="date_creation", type="date")
     */
    private $dateCreation;

    /**
     * @ORM\ManyToOne(targetEntity="PFE\V3\MobSurveyBundle\Entity\Enquete", inversedBy="questionnaires")
     * @ORM\JoinColumn(name="enquete", referencedColumnName="id", nullable=false)
     */
    private $enquete;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="PFE\V3\MobSurveyBundle\Entity\Question", orphanRemoval=true, mappedBy="questionnaire")
     */
    private $questions;

    /**
     * @var Question
     *
     * @ORM\OneToOne(targetEntity="PFE\V3\MobSurveyBundle\Entity\Question")
     */
    private $premiereQuestion;

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
     * @return Questionnaire
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
     * @param \Date  $dateCreation
     * @return Questionnaire
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    
        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \Date
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->questions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->dateCreation = new \DateTime("now");
    }
    
    /**
     * Set enquete
     *
     * @param \PFE\V3\MobSurveyBundle\Entity\Enquete $enquete
     * @return Questionnaire
     */
    public function setEnquete(\PFE\V3\MobSurveyBundle\Entity\Enquete $enquete)
    {
        $this->enquete = $enquete;
    
        return $this;
    }

    /**
     * Get enquete
     *
     * @return \PFE\V3\MobSurveyBundle\Entity\Enquete 
     */
    public function getEnquete()
    {
        return $this->enquete;
    }

    /**
     * Add questions
     *
     * @param \PFE\V3\MobSurveyBundle\Entity\Question $questions
     * @return Questionnaire
     */
    public function addQuestion(\PFE\V3\MobSurveyBundle\Entity\Question $questions)
    {
        $this->questions[] = $questions;
    
        return $this;
    }

    /**
     * Remove questions
     *
     * @param \PFE\V3\MobSurveyBundle\Entity\Question $questions
     */
    public function removeQuestion(\PFE\V3\MobSurveyBundle\Entity\Question $questions)
    {
        $this->questions->removeElement($questions);
    }

    /**
     * Get questions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    /**
     * Set premiereQuestion
     *
     * @param \PFE\V3\MobSurveyBundle\Entity\Question $premiereQuestion
     * @return Questionnaire
     */
    public function setPremiereQuestion(\PFE\V3\MobSurveyBundle\Entity\Question $premiereQuestion = null)
    {
        $this->premiereQuestion = $premiereQuestion;
    
        return $this;
    }

    /**
     * Get premiereQuestion
     *
     * @return \PFE\V3\MobSurveyBundle\Entity\Question 
     */
    public function getPremiereQuestion()
    {
        return $this->premiereQuestion;
    }

    public function __toString(){
        return $this->getTitre();
    }
}