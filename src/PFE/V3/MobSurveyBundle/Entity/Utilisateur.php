<?php

namespace PFE\V3\MobSurveyBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Utilisateur
 *
 * @ORM\Table()
 * @ORM\Entity
 *
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="role", type="string")
 * @ORM\DiscriminatorMap({ "webmaster"="WebMaster", "enqueteur" = "Enqueteur", "chef_enquete"="ChefEnquete", "superviseur"="Superviseur"})
 *
 * @ORM\HasLifecycleCallbacks
 */
abstract class Utilisateur extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity="PFE\V3\MobSurveyBundle\Entity\Groupe")
     * @ORM\JoinTable(name="fos_group",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     * )
     */
    protected $groups;
    /**
     * @ORM\Column(name="photo", type="string", nullable=true)
     * @Assert\File(maxSize="1024k", mimeTypes = {"image/jpeg", "image/png", "image/gif", "image/jpg"}, mimeTypesMessage = "Ce fichier doit être une image")
     */
    private $photo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected  $path;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prenom;
    /**
     * @ORM\Column(type="string", length=8, nullable=true)
     */
    private $cin;
    /**
     * @ORM\Column(type="string", length=12, nullable=true)
     */
    private $tel;
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $address;



    /*protected $groups;*/

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }


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
     * Add groups
     *
     * @param \PFE\V3\MobSurveyBundle\Entity\Groupe $groups
     * @return Utilisateur
     */
//    public function addGroup(\PFE\V3\MobSurveyBundle\Entity\Groupe $groups)
//    {
//        $this->groups[] = $groups;
//
//        return $this;
//    }

    /**
     * Remove groups
     *
     * @param \PFE\V3\MobSurveyBundle\Entity\Groupe $groups
     */
//    public function removeGroup(\PFE\V3\MobSurveyBundle\Entity\Groupe $groups)
//    {
//        $this->groups->removeElement($groups);
//    }

    /**
     * Get groups
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
//    public function getGroups()
//    {
//        return $this->groups;
//    }

    public function getAbsolutePath()
    {
        return null === $this->path ? null : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path ? null : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // le chemin absolu du répertoire où les documents uploadés doivent être sauvegardés
        return __DIR__.'/../../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // on se débarrasse de « __DIR__ » afin de ne pas avoir de problème lorsqu'on affiche
        // le document/image dans la vue.
        return 'uploads/ms/users/photos';
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->photo) {
            // faites ce que vous voulez pour générer un nom unique
            $this->path = sha1(uniqid(mt_rand(), true)).'.'.$this->photo->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->photo) {
            return;
        }

        // s'il y a une erreur lors du déplacement du fichier, une exception
        // va automatiquement être lancée par la méthode move(). Cela va empêcher
        // proprement l'entité d'être persistée dans la base de données si
        // erreur il y a
        $this->photo->move($this->getUploadRootDir(), $this->path);

        unset($this->photo);
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($photo = $this->getAbsolutePath()) {
            unlink($photo);
        }
    }



    /**
     * Set photo
     *
     * @param string $photo
     * @return Utilisateur
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    
        return $this;
    }

    /**
     * Get photo
     *
     * @return string 
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Utilisateur
     */
    public function setPath($path)
    {
        $this->path = $path;
    
        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }


    /**
     * Get groups
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGroups()
    {
        return $this->groups;
    }


    /**
     * Set nom
     *
     * @param string $nom
     * @return Utilisateur
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
     * Set prenom
     *
     * @param string $prenom
     * @return Utilisateur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    
        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set cin
     *
     * @param string $cin
     * @return Utilisateur
     */
    public function setCin($cin)
    {
        $this->cin = $cin;
    
        return $this;
    }

    /**
     * Get cin
     *
     * @return string 
     */
    public function getCin()
    {
        return $this->cin;
    }

    /**
     * Set tel
     *
     * @param string $tel
     * @return Utilisateur
     */
    public function setTel($tel)
    {
        $this->tel = $tel;
    
        return $this;
    }

    /**
     * Get tel
     *
     * @return string 
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Utilisateur
     */
    public function setAddress($address)
    {
        $this->address = $address;
    
        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }


}