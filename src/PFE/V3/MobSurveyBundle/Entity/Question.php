<?php

namespace PFE\V3\MobSurveyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Question
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PFE\V3\MobSurveyBundle\Entity\QuestionRepository")
 */
class Question
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
     * @ORM\Column(name="texte", type="string", length=255)
     */
    private $texte;

    /**
     * @var boolean
     *
     * @ORM\Column(name="obligatoire", type="boolean" , nullable=true)
     */
    private $obligatoire;

    /**
     * @ORM\ManyToOne(targetEntity="PFE\V3\MobSurveyBundle\Entity\QType")
     * @ORM\JoinColumn(name="q_type", referencedColumnName="id", nullable=false)
     */
    private $q_type;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="PFE\V3\MobSurveyBundle\Entity\Choix", orphanRemoval=true, mappedBy="question")
     */
    private $choix;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="PFE\V3\MobSurveyBundle\Entity\Reponse", orphanRemoval=true, mappedBy="question")
     */
    private $reponses;

    /**
     * @ORM\ManyToOne(targetEntity="PFE\V3\MobSurveyBundle\Entity\Questionnaire" , inversedBy="questions",cascade={"persist"})
     * @ORM\JoinColumn(name="questionnaire", referencedColumnName="id", nullable=false)
     */
    private $questionnaire;

    /**
     *
     * @ORM\ManyToOne(targetEntity="PFE\V3\MobSurveyBundle\Entity\Question")
     */
    private $questionSuivante;

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
     * @return Question
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
     * Set obligatoire
     *
     * @param boolean $obligatoire
     * @return Question
     */
    public function setObligatoire($obligatoire)
    {
        $this->obligatoire = $obligatoire;
    
        return $this;
    }

    /**
     * Get obligatoire
     *
     * @return boolean 
     */
    public function getObligatoire()
    {
        return $this->obligatoire;
    }
    /**
     * Constructor
     */
    public function __construct()
    {

        $this->setObligatoire(false);
        $this->choix = new \Doctrine\Common\Collections\ArrayCollection();
        $this->reponses = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set q_type
     *
     * @param \PFE\V3\MobSurveyBundle\Entity\QType $qType
     * @return Question
     */
    public function setQType(\PFE\V3\MobSurveyBundle\Entity\QType $qType)
    {
        $this->q_type = $qType;
    
        return $this;
    }

    /**
     * Get q_type
     *
     * @return \PFE\V3\MobSurveyBundle\Entity\QType 
     */
    public function getQType()
    {
        return $this->q_type;
    }

    /**
     * Add choix
     *
     * @param \PFE\V3\MobSurveyBundle\Entity\Choix $choix
     * @return Question
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
     * Add reponses
     *
     * @param \PFE\V3\MobSurveyBundle\Entity\Reponse $reponses
     * @return Question
     */
    public function addReponse(\PFE\V3\MobSurveyBundle\Entity\Reponse $reponses)
    {
        $this->reponses[] = $reponses;
    
        return $this;
    }

    /**
     * Remove reponses
     *
     * @param \PFE\V3\MobSurveyBundle\Entity\Reponse $reponses
     */
    public function removeReponse(\PFE\V3\MobSurveyBundle\Entity\Reponse $reponses)
    {
        $this->reponses->removeElement($reponses);
    }

    /**
     * Get reponses
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getReponses()
    {
        return $this->reponses;
    }

    /**
     * Set questionnaire
     *
     * @param \PFE\V3\MobSurveyBundle\Entity\Questionnaire $questionnaire
     * @return Question
     */
    public function setQuestionnaire(\PFE\V3\MobSurveyBundle\Entity\Questionnaire $questionnaire)
    {
        $this->questionnaire = $questionnaire;
    
        return $this;
    }

    /**
     * Get questionnaire
     *
     * @return \PFE\V3\MobSurveyBundle\Entity\Questionnaire 
     */
    public function getQuestionnaire()
    {
        return $this->questionnaire;
    }

    /**
     * Set questionSuivante
     *
     * @param \PFE\V3\MobSurveyBundle\Entity\Question $questionSuivante
     * @return Question
     */
    public function setQuestionSuivante(\PFE\V3\MobSurveyBundle\Entity\Question $questionSuivante = null)
    {
        $this->questionSuivante = $questionSuivante;
    
        return $this;
    }

    /**
     * Get questionSuivante
     *
     * @return \PFE\V3\MobSurveyBundle\Entity\Question 
     */
    public function getQuestionSuivante()
    {
        return $this->questionSuivante;
    }

    public function __toString(){
        return $this->getTexte();
    }
}