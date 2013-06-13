<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anonymous
 * Date: 08/04/13
 * Time: 12:42
 * To change this template use File | Settings | File Templates.
 */


namespace PFE\V3\MobSurveyBundle\Controller\Rest;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;


class QuestionnairesController extends FOSRestController
{


    public function getQuestionnaireAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $questionnaire = $em->getRepository("MSBundle:Questionnaire")->findOneById($id);

        $premiereQuestion = ($questionnaire->getPremiereQuestion() == null)? array() : array("id" => $questionnaire->getPremiereQuestion()->getId(),
            "texte" => $questionnaire->getPremiereQuestion()->getTexte());

        $questions = new \Doctrine\Common\Collections\ArrayCollection();
        foreach($questionnaire->getQuestions() as $question){
            $questions[] = array("id" => $question->getId(), "text" => $question->getTexte(),
                "type" => $question->getQType()->getValeur(), "obligatoire" => $question->getObligatoire(),
                "questionSuivant" => ($question->getQuestionSuivante() != null)? $question->getQuestionSuivante()->getTexte() : "");
        }
        $view = $this->view(
            array(
                "id" => $questionnaire->getId(),
                "titre" => $questionnaire->getTitre(),
                "premiereQuestion" => $premiereQuestion,
                "questions" => $questions

            )
        );

        return $this->handleView($view);

    }

    public function postQuestionnaireAction($id){

        $em = $this->getDoctrine()->getEntityManager();
        $questionnaire = $em->getRepository("MSBundle:Questionnaire")->findOneById($id);

        $premiereQuestion = ($questionnaire->getPremiereQuestion() == null)? array() : array("id" => $questionnaire->getPremiereQuestion()->getId(),
            "texte" => $questionnaire->getPremiereQuestion()->getTexte(),
        "questionSuivante" => ($questionnaire->getPremiereQuestion()->getQuestionSuivante() == null )? 0 : $questionnaire->getPremiereQuestion()->getQuestionSuivante()->getId());


        $view = $this->view(
            array(
                "id" => $questionnaire->getId(),
                "titre" => $questionnaire->getTitre(),
                "premiereQuestion" => $premiereQuestion

            )
        );

        return $this->handleView($view);
    }

    public function getQuestionAction($question_id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $question = $em->getRepository("MSBundle:Question")->findOneById($question_id);

        $choix_question = new \Doctrine\Common\Collections\ArrayCollection();
        foreach($question->getChoix() as $choix){
            $choix_question [] = array("id" => $choix->getId(), "valeur" => $choix->getValeur() , "ch_type" => $choix->getChType(), "attachedQuestion" => ($choix->getAttachedQuestion() == null)? 0 : $choix->getAttachedQuestion()->getId());
        }
        $view = $this->view(
            array(
                "id" => $question->getId(),
                "texte" => $question->getTexte(),
                "type" => $question->getQType()->getValeur(),
                "obligatoire" => $question->getObligatoire(),
                "choix" => $choix_question,
                "questionSuivante" => ($question->getQuestionSuivante() == null)? 0 : $question->getQuestionSuivante()->getId()
            )
        );

        return $this->handleView($view);

    }

}
