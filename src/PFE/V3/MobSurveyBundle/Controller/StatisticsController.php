<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anis
 * Date: 21/06/13
 * Time: 04:40
 * To change this template use File | Settings | File Templates.
 */

namespace PFE\V3\MobSurveyBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use FOS\RestBundle\Controller\FOSRestController;

/**
 * Statistics controller.
 *
 * @Route("/statistics")
 */
class StatisticsController extends FOSRestController
{

    /**
     * @Route("/repondant", name="statistics_gender")
     * @Method("GET")
     * @Template()
     */
    public function repondantAction()
    {
        return array();
    }


    /**
     * @Route("/repondants", name="get_respondents", defaults={"_format"="json"})
     * @Method("GET")
     */
    public  function repondantsAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $respondents = $em->getRepository("MSBundle:Repondant")->findAll();
        $data [] = array();
        foreach($respondents as $resp)
        {
            $data[] = array("sexe" => $resp->getSexe(), "age" => $resp->getAge());
        }
        $view = $this->view($data , 200);

        return $this->handleView( $view );
    }


    /**
     *
     * @Route("/questionnaire/{id}", name="statistics_questionnaire")
     * @Method("GET")
     * @Template()
     */
    public function questionnaireAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $questionnaire = $em->getRepository("MSBundle:Questionnaire")->findOneById($id);

        $data = array();
        $data["titre"] = $questionnaire->getTitre();

        $questions = array();
        /*foreach($questionnaire->getQuestion() as $question)
        {
           $questions[]
        }*/
        $questions = $questionnaire->getQuestions();

        $data["questions"] = $questions;
        return $data;
    }


    /**
     *
     * @Route("/question/{id}", name="statistics_question")
     * @Method("GET")
     * @Template()
     */
    public function questionAction($id)
    {

    }

}
