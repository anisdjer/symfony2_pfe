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


    public function getEnqueteurEnquetesAction($slug)
    {

        $em = $this->getDoctrine()->getEntityManager();

        $enqueteur = $em->getRepository("MSBundle:Enqueteur")->findOneById($slug);


        $result = "Echec";
        if(! empty($enqueteur)){

            $enquetes_id = new \Doctrine\Common\Collections\ArrayCollection();
            //$enquetes_id[] = array("id" => 0, "titre" => $enqueteur->getDevice(),"questionnaire" => array());

            $equipes = $enqueteur->getEquipes();
            $enquetesList = array();
            foreach($equipes as $eq){
                foreach($eq->getEnquetes() as $enqu)
                {
                    if(! key_exists($enqu->getId() , $enquetesList))
                        $enquetesList[$enqu->getId()] = $enqu;
                }
            }


            foreach($enquetesList as $enq){

                $questionnaire = $enq->getQuestionnaires();
                $questionnaires= new \Doctrine\Common\Collections\ArrayCollection();

                foreach($questionnaire as $qest){
                    $questionnaires[] = array("id" => $qest->getId(), "titre" => $qest->getTitre(),"date_creation" => $qest->getDateCreation()->getTimestamp() , "premiereQuestion" => ($qest->getPremiereQuestion() == null)? 0 : $qest->getPremiereQuestion()->getId());
                }

                $enquetes_id[] = array("id" => $enq->getId(), "titre" => $enq->getTitre(), "questionnaire" => $questionnaires);

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

    public function postEnqueteurFichesAction($enqueteur_id)
    {
        try{
            $j = json_decode($this->getRequest()->getContent());

            $respondent = new \PFE\V3\MobSurveyBundle\Entity\Repondant();

            $respondent->setNom($j->name.' '.$j->last_name);
            $respondent->setAge($j->age);
            $respondent->setSexe($j->genre);
            $respondent->setAnswertime($j->answered);




            $em = $this->getDoctrine()->getEntityManager();
            $resp = $em->getRepository("MSBundle:Repondant")->findOneByAnswertime($respondent->getAnswertime());
            if($resp == null){
                $em->persist($respondent);

            }
            else
            {
                $respondent = $resp;
            }

            // TODO : les fiches

            $fiche = $j->fiche;
            $Fiche = new \PFE\V3\MobSurveyBundle\Entity\FicheReponse();
            $Fiche->setQuestionnaire($em->getRepository("MSBundle:Questionnaire")->findOneById($fiche->questionnaire));
            $Fiche->setEnqueteur($em->getRepository("MSBundle:Enqueteur")->findOneById($fiche->enqueteur));
            $Fiche->setRepondant($respondent);
            $Fiche->setAnswertime($fiche->answered);

            $em->persist($Fiche);

            foreach($fiche->reponses as $rep)
            {
                $reponse = new \PFE\V3\MobSurveyBundle\Entity\Reponse();
                $reponse->setQuestion($em->getRepository("MSBundle:Question")->findOneById($rep->question));
                $reponse->setFicheReponse($Fiche);
                if($reponse->getQuestion()->getQType() == "texte")
                {
                    $reponse->setValeur($rep->valeur);
                }
                else
                {
                    $reponse->setValeur(""); // valeur can not be null | modifier l'entité réponse
                    $choices = new \Doctrine\Common\Collections\ArrayCollection();
                    foreach($rep->choix as $choix)
                    {
                        $Choix = $em->getRepository("MSBundle:Choix")->findOneById($choix);
                        $reponse->addChoix($Choix);
                        $Choix->addReponse($reponse);
                        $em->persist($Choix);
                    }
                }


                $em->persist($reponse);
            }



            $em->flush();
            die();
        }catch (\Symfony\Component\Config\Definition\Exception\Exception $e){}
    }


    // A supprimer : juste pour un test
//    public  function getRespondentsAction()
//    {
//        $em = $this->getDoctrine()->getEntityManager();
//        $respondents = $em->getRepository("MSBundle:Repondant")->findAll();
//        $data [] = array();
//        foreach($respondents as $resp)
//        {
//            $data[] = array("sexe" => $resp->getSexe(), "age" => $resp->getAge());
//        }
//        $view = $this->view($data , 200);
//
//        return $this->handleView( $view );
//    }

}
