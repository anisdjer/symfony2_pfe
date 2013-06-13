<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anis
 * Date: 12/06/13
 * Time: 16:28
 * To change this template use File | Settings | File Templates.
 */
namespace PFE\V3\MobSurveyBundle\Controller\Rest;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;

class SuperviseursController extends FOSRestController
{


    public function getSuperviseurEquipesAction($id_superviseur)
    {


        $em = $this->getDoctrine()->getEntityManager();

        $superviseur = $em->getRepository("MSBundle:Superviseur")->findOneById($id_superviseur);

        if(! empty($superviseur)){
            $equipe = new \Doctrine\Common\Collections\ArrayCollection();
            $equipes = $superviseur->getEquipes();
            foreach($equipes as $eq){
                $enqueteurs = new \Doctrine\Common\Collections\ArrayCollection();
                foreach($eq->getEnqueteurs() as $enq){
                    $enqueteurs[] = array("id" => $enq->getId(), "username" => $enq->getUsername());
                }
                $equipe[] = array("id" => $eq->getId(),
                    "superviseur" => array( "id" => $eq->getSuperviseur()->getId(), "username" => $eq->getSuperviseur()->getUsername()) ,
                    "enqueteurs" => $enqueteurs
                );

            }

            $view = $this->view($equipe , 200);

            return $this->handleView( $view );
        }
        $view = $this->view(array() , 404);

        return $this->handleView( $view );


    }

}
