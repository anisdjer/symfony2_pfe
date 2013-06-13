<?php

namespace PFE\V3\MobSurveyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Enquete
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PFE\V3\MobSurveyBundle\Entity\EnqueteRepository")
 */
class Enquete
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
     * @var string
     *
     * @ORM\Column(name="description", type="text" , nullable=true)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="date")
     */
    private $dateCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="date")
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="date")
     */
    private $dateFin;


    /**
     * @ORM\ManyToOne(targetEntity="PFE\V3\MobSurveyBundle\Entity\Campagne", inversedBy="enquetes")
     * @ORM\JoinColumn(name="campagne", referencedColumnName="id", nullable=false)
     */
    private $campagne;


    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="PFE\V3\MobSurveyBundle\Entity\Questionnaire", orphanRemoval=true, mappedBy="enquete")
     */
    private $questionnaires;



    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="PFE\V3\MobSurveyBundle\Entity\Equipe" , mappedBy="enquetes")
     * @ORM\JoinColumn(name="equipe_id", referencedColumnName="id", nullable=true)
     */
    private $equipes;

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
     * @return Enquete
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
     * Set titre
     *
     * @param string $titre
     * @return Enquete
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return Enquete
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
     * Set dateDebut
     *
     * @param \DateTime $dateCreation
     * @return Enquete
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }
    /**
     * Set dateFin
     *
     * @param \DateTime $dateCreation
     * @return Enquete
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->questionnaires = new \Doctrine\Common\Collections\ArrayCollection();
        $this->equipes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->dateCreation = new \DateTime("now");
    }
    
    /**
     * Set campagne
     *
     * @param \PFE\V3\MobSurveyBundle\Entity\Campagne $campagne
     * @return Enquete
     */
    public function setCampagne(\PFE\V3\MobSurveyBundle\Entity\Campagne $campagne)
    {
        $this->campagne = $campagne;
    
        return $this;
    }

    /**
     * Get campagne
     *
     * @return \PFE\V3\MobSurveyBundle\Entity\Campagne 
     */
    public function getCampagne()
    {
        return $this->campagne;
    }

    /**
     * Add questionnaires
     *
     * @param \PFE\V3\MobSurveyBundle\Entity\Questionnaire $questionnaires
     * @return Enquete
     */
    public function addQuestionnaire(\PFE\V3\MobSurveyBundle\Entity\Questionnaire $questionnaires)
    {
        $this->questionnaires[] = $questionnaires;
    
        return $this;
    }

    /**
     * Remove questionnaires
     *
     * @param \PFE\V3\MobSurveyBundle\Entity\Questionnaire $questionnaires
     */
    public function removeQuestionnaire(\PFE\V3\MobSurveyBundle\Entity\Questionnaire $questionnaires)
    {
        $this->questionnaires->removeElement($questionnaires);
    }

    /**
     * Get questionnaires
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getQuestionnaires()
    {
        return $this->questionnaires;
    }

    /**
     * Add equipes
     *
     * @param \PFE\V3\MobSurveyBundle\Entity\Equipe $equipes
     * @return Enquete
     */
    public function addEquipe(\PFE\V3\MobSurveyBundle\Entity\Equipe $equipes)
    {
        $this->equipes[] = $equipes;
    
        return $this;
    }

    /**
     * Remove equipes
     *
     * @param \PFE\V3\MobSurveyBundle\Entity\Equipe $equipes
     */
    public function removeEquipe(\PFE\V3\MobSurveyBundle\Entity\Equipe $equipes)
    {
        $this->equipes->removeElement($equipes);
    }

    /**
     * Get equipes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEquipes()
    {
        return $this->equipes;
    }

    public function __toString(){
        return $this->getTitre();
    }
}