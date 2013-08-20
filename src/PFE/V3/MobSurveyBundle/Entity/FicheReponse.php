<?php

namespace PFE\V3\MobSurveyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FicheReponse
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PFE\V3\MobSurveyBundle\Entity\FicheReponseRepository")
 */
class FicheReponse
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
     * @ORM\ManyToOne(targetEntity="PFE\V3\MobSurveyBundle\Entity\Repondant" , cascade={"persist"})
     * @ORM\JoinColumn(name="repondant", referencedColumnName="id", nullable=false)
     */
    private $repondant;


    /**
     * @ORM\ManyToOne(targetEntity="PFE\V3\MobSurveyBundle\Entity\Questionnaire" , cascade={"persist"})
     * @ORM\JoinColumn(name="questionnaire", referencedColumnName="id", nullable=false)
     */
    private $questionnaire;

    /**
     * @ORM\ManyToOne(targetEntity="PFE\V3\MobSurveyBundle\Entity\Enqueteur"  ,cascade={"persist"})
     * @ORM\JoinColumn(name="enqueteur", referencedColumnName="id", nullable=false)
     */
    private $enqueteur;

    /**
     * @var long
     *
     * @ORM\Column(name="date_reponse", type="bigint")
     */
    private $answertime;


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
     * Set repondant
     *
     * @param \PFE\V3\MobSurveyBundle\Entity\Repondant $repondant
     * @return FicheReponse
     */
    public function setRepondant(\PFE\V3\MobSurveyBundle\Entity\Repondant $repondant)
    {
        $this->repondant = $repondant;
    
        return $this;
    }

    /**
     * Get repondant
     *
     * @return \PFE\V3\MobSurveyBundle\Entity\Repondant 
     */
    public function getRepondant()
    {
        return $this->repondant;
    }

    /**
     * Set questionnaire
     *
     * @param \PFE\V3\MobSurveyBundle\Entity\Questionnaire $questionnaire
     * @return FicheReponse
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
     * Set enqueteur
     *
     * @param \PFE\V3\MobSurveyBundle\Entity\Enqueteur $enqueteur
     * @return FicheReponse
     */
    public function setEnqueteur(\PFE\V3\MobSurveyBundle\Entity\Enqueteur $enqueteur)
    {
        $this->enqueteur = $enqueteur;
    
        return $this;
    }

    /**
     * Get enqueteur
     *
     * @return \PFE\V3\MobSurveyBundle\Entity\Enqueteur 
     */
    public function getEnqueteur()
    {
        return $this->enqueteur;
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