<?php

namespace PFE\V3\MobSurveyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Equipe
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PFE\V3\MobSurveyBundle\Entity\EquipeRepository")
 */
class Equipe
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    private $centerX;
    private $centerY;
    private $raduis;

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
     * @ORM\ManyToOne(targetEntity="PFE\V3\MobSurveyBundle\Entity\Superviseur" , inversedBy="equipes")
     * @ORM\JoinColumn(name="superviseur_id", referencedColumnName="id", nullable=false)
     */
    private $superviseur;


    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="PFE\V3\MobSurveyBundle\Entity\Enqueteur",   inversedBy="equipes")
     */
    private $enqueteurs;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="PFE\V3\MobSurveyBundle\Entity\Enquete",   inversedBy="equipes", fetch="EAGER")
     * @ORM\JoinColumn(name="enquete_id", referencedColumnName="id", nullable=true)
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
     * Constructor
     */
    public function __construct()
    {
        $this->enqueteurs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->enquetes = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set superviseur
     *
     * @param \PFE\V3\MobSurveyBundle\Entity\Superviseur $superviseur
     * @return Equipe
     */
    public function setSuperviseur(\PFE\V3\MobSurveyBundle\Entity\Superviseur $superviseur)
    {
        $this->superviseur = $superviseur;
    
        return $this;
    }

    /**
     * Get superviseur
     *
     * @return \PFE\V3\MobSurveyBundle\Entity\Superviseur 
     */
    public function getSuperviseur()
    {
        return $this->superviseur;
    }

    /**
     * Add enqueteurs
     *
     * @param \PFE\V3\MobSurveyBundle\Entity\Enqueteur $enqueteurs
     * @return Equipe
     */
    public function addEnqueteur(\PFE\V3\MobSurveyBundle\Entity\Enqueteur $enqueteurs)
    {
        $this->enqueteurs[] = $enqueteurs;
    
        return $this;
    }

    /**
     * Remove enqueteurs
     *
     * @param \PFE\V3\MobSurveyBundle\Entity\Enqueteur $enqueteurs
     */
    public function removeEnqueteur(\PFE\V3\MobSurveyBundle\Entity\Enqueteur $enqueteurs)
    {
        $this->enqueteurs->removeElement($enqueteurs);
    }

    /**
     * Get enqueteurs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEnqueteurs()
    {
        return $this->enqueteurs;
    }

    /**
     * Add enquetes
     *
     * @param \PFE\V3\MobSurveyBundle\Entity\Enquete $enquetes
     * @return Equipe
     */
    public function addEnquete(\PFE\V3\MobSurveyBundle\Entity\Enquete $enquetes)
    {
        $this->enquetes[] = $enquetes;

        foreach($this->enqueteurs as $eq)
        {
            $eq->notify("Nouvelle enquete");
        }
    
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

    public function __toString(){
        return $this->getSuperviseur()->getUsername();
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     * @return Equipe
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
        if(count($this->getEnquetes()) > 0)
        {
            $this->dateDebut = $this->getEnquetes()->get(0)->getDateDebut();
            foreach($this->getEnquetes() as $enquete)
            {
                if($enquete->getDateDebut() < $this->dateDebut)
                    $this->setDateDebut($enquete->getDateDebut());
            }
        }
        else
            $this->setDateDebut(new \DateTime("now"));


        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     * @return Equipe
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
        if(count($this->getEnquetes()) > 0)
        {
            $this->dateFin = $this->getEnquetes()->get(0)->getDateFin();
            foreach($this->getEnquetes() as $enquete)
            {
                if($enquete->getDateFin() < $this->dateFin)
                    $this->setDateFin($enquete->getDateFin());
            }
        }
        else
            $this->setDateFin(new \DateTime("now"));

        return $this->dateFin;
    }

    public function getCenterX()
    {
        return $this->centerX;
    }

    public function setCenterX($centerX)
    {
        $this->centerX = $centerX;
    }

    public function getCenterY()
    {
        return $this->centerY;
    }

    public function setCenterY($centerY)
    {
        $this->centerY = $centerY;
    }

    public function getRaduis()
    {
        return $this->raduis;
    }

    public function setRaduis($raduis)
    {
        $this->raduis = $raduis;
    }
}