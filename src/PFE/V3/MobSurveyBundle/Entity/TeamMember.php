<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anis
 * Date: 20/05/13
 * Time: 00:56
 * To change this template use File | Settings | File Templates.
 */

namespace PFE\V3\MobSurveyBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

abstract class TeamMember extends Mobile
{


    protected $equipes;

//    /**
//     * @var \DateTime
//     *
//     */
//    protected $dateDebut;
//
//    /**
//     * @var \DateTime
//     *
//     */
//    protected $dateFin;

    /**
     * @var boolean
     */
    protected $occupied;


    public function __construct()
    {
        parent::__construct();
        $this->equipes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add equipe
     *
     * @param \PFE\V3\MobSurveyBundle\Entity\Equipe $equipe
     * @return Enqueteur
     */
    public function addEquipe(\PFE\V3\MobSurveyBundle\Entity\Equipe $equipe)
    {
        $this->equipes[] = $equipe;

        return $this;
    }

    /**
     * Remove equipe
     *
     * @param \PFE\V3\MobSurveyBundle\Entity\Equipe $equipe
     */
    public function removeEquipe(\PFE\V3\MobSurveyBundle\Entity\Equipe $equipe)
    {
        $this->equipes->removeElement($equipe);
    }

    /**
     * Get equipe
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEquipes()
    {
        return $this->equipes;
    }

    public function isOccupied($dateDebut,$dateFin)
    {
        $this->occupied = false;

        foreach($this->getEquipes() as $equipe)
        {
            if( $equipe->getDateDebut() < $dateDebut)
            {
                if( ($equipe->getDateFin() > $dateDebut))
                {
                    $this->occupied = true;
                    return true;
                }
            }
            else if ( $equipe->getDateDebut() < $dateFin)
            {
                $this->occupied = true;
                return true;
            }


        }
        return false;
    }
//    /**
//     * Set dateDebut
//     *
//     * @param \DateTime $dateDebut
//     * @return Superviseur
//     */
//    public function setDateDebut($dateDebut)
//    {
//
//        $this->dateDebut = $dateDebut;
//
//        return $this;
//    }
//
//    /**
//     * Get dateDebut
//     *
//     * @return \DateTime
//     */
//    public function getDateDebut()
//    {
//        if(count($this->getEquipes()) > 0)
//        {
//            $this->dateDebut = $this->getEquipes()->get(0)->getDateDebut();
//            foreach($this->getEquipes() as $equipe)
//            {
//                if($equipe->getDateDebut() < $this->dateDebut)
//                    $this->setDateDebut($equipe->getDateDebut());
//            }
//        }
//        else
//            $this->setDateDebut(new \DateTime("now"));
//
//
//        return $this->dateDebut;
//    }
//
//    /**
//     * Set dateFin
//     *
//     * @param \DateTime $dateFin
//     * @return Superviseur
//     */
//    public function setDateFin($dateFin)
//    {
//        $this->dateFin = $dateFin;
//
//        return $this;
//    }
//
//    /**
//     * Get dateFin
//     *
//     * @return \DateTime
//     */
//    public function getDateFin()
//    {
//        if(count($this->getEquipes()) > 0)
//        {
//            $this->dateFin = $this->getEquipes()->get(0)->getDateFin();
//            foreach($this->getEquipes() as $equipe)
//            {
//                if($equipe->getDateFin() < $this->dateFin)
//                    $this->setDateFin($equipe->getDateFin());
//            }
//        }
//        else
//            $this->setDateFin(new \DateTime("now"));
//
//        return $this->dateFin;
//    }
}
