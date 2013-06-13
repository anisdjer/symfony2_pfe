<?php
/**
 * Created by JetBrains PhpStorm.
 * Enqueteur: Anonyme
 * Date: 28/02/13
 * Time: 20:47
 * To change this template use File | Settings | File Templates.
 */



namespace PFE\V3\MobSurveyBundle\Controller\Rest;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;

class EnqueteursController extends FOSRestController
{

    public function optionsEnqueteursAction()
    {

        $view = $this->view(array('Enqueteurs' => "Ok"))
        ;

        return $this->handleView($view);


    } // "options_enqueteurs" [OPTIONS] /enqueteurs

    public function getEnqueteursAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $data = $em->getRepository("MSBundle:Enqueteur")->findAll();

        $view = $this->view($data)
        ;

        return $this->handleView($view);
    } // "get_enqueteurs"     [GET] /enqueteurs

    public function newEnqueteursAction()
    {
        $id = $this->getRequest()->query->get("id");
        $enqueteur = "Enqueteur";
        $view = $this->view(array('Enqueteurs' => "Get newEnqueteur",$enqueteur => $id))
        ;

        return $this->handleView($view);
    } // "new_enqueteurs"     [GET] /enqueteurs/new

    public function postEnqueteursAction()
    {
        $header =  $this->getRequest()->getUser();
        echo var_dump($header);die();
        $view = $this->view(array('Enqueteurs' => $this->getRequest()))
        ;

        return $this->handleView($view);
    } // "post_enqueteurs"    [POST] /enqueteurs

    public function patchEnqueteursAction()
    {
        $view = $this->view(array('Enqueteurs' => "Ok"))
        ;

        return $this->handleView($view);
    } // "patch_enqueteurs"   [PATCH] /enqueteurs




    public function getEnqueteurAction($slug)
    {






        $em = $this->getDoctrine()->getEntityManager();

        try{
        $enqueteur = $em->getRepository("MSBundle:Enqueteur")->findOneById($slug);
        $result = "Echec";
        if(! empty($enqueteur)){




//            $salted = "anisanis{".$enqueteur->getSalt()."}";//$this->mergePasswordAndSalt($raw, $salt);
//            $digest = hash("sha512", $salted, true);
//
//            // "stretch" hash
//            for ($i = 1; $i < 5000; $i++) {
//                $digest = hash("sha512", $digest.$salted, true);
//            }
//
//            echo base64_encode($digest).'<br />'.$enqueteur->getPassword() ;die();
//




                $result = $enqueteur->getId();
                $view = $this->view(array('enqueteurs' => $enqueteur->serialize()));

            }
            else
                $view = $this->view(array());

        }catch (\Doctrine\ORM\EntityNotFoundException $ex){
            $view = $this->view(array());
        }




        return $this->handleView($view);
    } // "get_enqueteur"      [GET] /enqueteurs/{slug}





    public function editEnqueteurAction($slug)
    {
        $view = $this->view(array('Enqueteurs' => "Ok"))
        ;

        return $this->handleView($view);
    } // "edit_enqueteur"     [GET] /enqueteurs/{slug}/edit

    public function putEnqueteurAction($slug)
    {
        $view = $this->view(array('Enqueteurs' => "Ok"))
        ;

        return $this->handleView($view);
    } // "put_enqueteur"      [PUT] /enqueteurs/{slug}

    public function patchEnqueteurAction($slug)
    {
        $view = $this->view(array('Enqueteurs' => "Ok"))
        ;

        return $this->handleView($view);
    } // "patch_enqueteur"    [PATCH] /enqueteurs/{slug}

    public function lockEnqueteurAction($slug)
    {
        $view = $this->view(array('Enqueteurs' => "Ok"))
        ;

        return $this->handleView($view);
    } // "lock_enqueteur"     [PATCH] /enqueteurs/{slug}/lock

    public function banEnqueteurAction($slug)
    {
        $view = $this->view(array('Enqueteurs' => "Ok"))
        ;

        return $this->handleView($view);
    } // "ban_enqueteur"      [PATCH] /enqueteurs/{slug}/ban





    public function removeEnqueteurAction($slug)
    {

        $em = $this->getDoctrine()->getEntityManager();

        $enqueteur = $em->getRepository("MSBundle:Enqueteur")->find($slug);
        $view = $this->view(array('enqueteurs' => $enqueteur))
        ;

        return $this->handleView($view);
    } // "remove_enqueteur"   [GET] /enqueteurs/{slug}/remove







    public function deleteEnqueteurAction($slug)
    {
        $view = $this->view(array('Enqueteurs' => "Ok"))
        ;

        return $this->handleView($view);
    } // "delete_enqueteur"   [DELETE] /enqueteurs/{slug}











    public function getEnqueteurEnquetesAction($slug)
    {

        $em = $this->getDoctrine()->getEntityManager();

        $enqueteur = $em->getRepository("MSBundle:Enqueteur")->findOneById($slug);


        $result = "Echec";
        if(! empty($enqueteur)){

            $enquetes_id = new \Doctrine\Common\Collections\ArrayCollection();
            //$enquetes_id[] = array("id" => 0, "titre" => $enqueteur->getDevice(),"questionnaire" => array());

            $equipes = $enqueteur->getEquipes();
            foreach($equipes as $eq){
                $enquetes = $eq->getEnquetes();
                foreach($enquetes as $enq){
                    $questionnaire = $enq->getQuestionnaires();
                    $questionnaires= new \Doctrine\Common\Collections\ArrayCollection();

                    foreach($questionnaire as $qest){
                        $questionnaires[] = array("id" => $qest->getId(), "titre" => $qest->getTitre(),"date_creation" => $qest->getDateCreation()->getTimestamp() , "premiereQuestion" => ($qest->getPremiereQuestion() == null)? 0 : $qest->getPremiereQuestion()->getId());
                    }

                    $enquetes_id[] = array("id" => $enq->getId(), "titre" => $enq->getTitre(), "questionnaire" => $questionnaires);

                }
            }

//            $enquetes[0]=array("dd" => "ee");
            $view = $this->view($enquetes_id , 200);

            return $this->handleView( $view );

        }

        $view = $this->view(array('enqueteurs' => $result), 404);

        return $this->handleView($view);


        
    } // "get_enqueteur_enquetes"    [GET] /enqueteurs/{slug}/enquetes


    public function getEnqueteurEquipesAction($slug)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $enqueteur = $em->getRepository("MSBundle:Enqueteur")->findOneById($slug);

        $result = "Echec";
        if(! empty($enqueteur)){
            $equipe = new \Doctrine\Common\Collections\ArrayCollection();
            $equipes = $enqueteur->getEquipes();
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
    }// "get_enqueteur_enquetes"    [GET] /enqueteurs/{slug}/equipes






    public function newEnqueteurEnquetesAction($slug)
    {} // "new_enqueteur_enquetes"    [GET] /enqueteurs/{slug}/enquetes/new

    public function postEnqueteurEnquetesAction($slug)
    {

        echo $slug;die();

    } // "post_enqueteur_enquetes"   [POST] /enqueteurs/{slug}/enquetes

    public function getEnqueteurEnqueteAction($slug, $id)
    {} // "get_enqueteur_enquete"     [GET] /enqueteurs/{slug}/enquetes/{id}

    public function editEnqueteurEnqueteAction($slug, $id)
    {} // "edit_enqueteur_enquete"    [GET] /enqueteurs/{slug}/enquetes/{id}/edit

    public function putEnqueteurEnqueteAction($slug, $id)
    {} // "put_enqueteur_enquete"     [PUT] /enqueteurs/{slug}/enquetes/{id}

    public function postEnqueteurEnqueteVoteAction($slug, $id)
    {} // "post_enqueteur_enquete_vote" [POST] /enqueteurs/{slug}/enquetes/{id}/vote

    public function removeEnqueteurEnqueteAction($slug, $id)
    {} // "remove_enqueteur_enquete"  [GET] /enqueteurs/{slug}/enquetes/{id}/remove

    public function deleteEnqueteurEnqueteAction($slug, $id)
    {} // "delete_enqueteur_enquete"  [DELETE] /enqueteurs/{slug}/enquetes/{id}










    public function linkEnqueteurAction($slug)
    {} // "link_enqueteur_friend"     [LINK] /enqueteurs/{slug}

    public function unlinkEnqueteurAction($slug)
    {} // "link_enqueteur_friend"     [UNLINK] /enqueteurs/{slug}
}
