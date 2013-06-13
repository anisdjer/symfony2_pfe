<?php

namespace PFE\V3\MobSurveyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Communication
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PFE\V3\MobSurveyBundle\Entity\CommunicationRepository")
 */
class Communication
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
     * @ORM\Column(name="objet", type="string", length=255)
     */
    private $objet;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text")
     */
    private $message;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_envoie", type="date")
     */
    private $dateEnvoie;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_consultation", type="date")
     */
    private $dateConsultation;

    /**
     * @var boolean
     *
     * @ORM\Column(name="notification", type="boolean")
     */
    private $notification;

    /**
     * @ORM\ManyToMany(targetEntity="PFE\V3\MobSurveyBundle\Entity\Utilisateur" )
     */
    private $destinataires;

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
     * Set objet
     *
     * @param string $objet
     * @return Communication
     */
    public function setObjet($objet)
    {
        $this->objet = $objet;
    
        return $this;
    }

    /**
     * Get objet
     *
     * @return string 
     */
    public function getObjet()
    {
        return $this->objet;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return Communication
     */
    public function setMessage($message)
    {
        $this->message = $message;
    
        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set dateEnvoie
     *
     * @param \DateTime $dateEnvoie
     * @return Communication
     */
    public function setDateEnvoie($dateEnvoie)
    {
        $this->dateEnvoie = $dateEnvoie;
    
        return $this;
    }

    /**
     * Get dateEnvoie
     *
     * @return \DateTime 
     */
    public function getDateEnvoie()
    {
        return $this->dateEnvoie;
    }

    /**
     * Set dateConsultation
     *
     * @param \DateTime $dateConsultation
     * @return Communication
     */
    public function setDateConsultation($dateConsultation)
    {
        $this->dateConsultation = $dateConsultation;
    
        return $this;
    }

    /**
     * Get dateConsultation
     *
     * @return \DateTime 
     */
    public function getDateConsultation()
    {
        return $this->dateConsultation;
    }

    /**
     * Set notification
     *
     * @param boolean $notification
     * @return Communication
     */
    public function setNotification($notification)
    {
        $this->notification = $notification;
    
        return $this;
    }

    /**
     * Get notification
     *
     * @return boolean 
     */
    public function getNotification()
    {
        return $this->notification;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->destinataires = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add destinataires
     *
     * @param \PFE\V3\MobSurveyBundle\Entity\Utilisateur $destinataires
     * @return Communication
     */
    public function addDestinataire(\PFE\V3\MobSurveyBundle\Entity\Utilisateur $destinataires)
    {
        $this->destinataires[] = $destinataires;
    
        return $this;
    }

    /**
     * Remove destinataires
     *
     * @param \PFE\V3\MobSurveyBundle\Entity\Utilisateur $destinataires
     */
    public function removeDestinataire(\PFE\V3\MobSurveyBundle\Entity\Utilisateur $destinataires)
    {
        $this->destinataires->removeElement($destinataires);
    }

    /**
     * Get destinataires
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDestinataires()
    {
        return $this->destinataires;
    }

    /**
     * Set createur
     *
     * @param \PFE\V3\MobSurveyBundle\Entity\Utilisateur $createur
     * @return Communication
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