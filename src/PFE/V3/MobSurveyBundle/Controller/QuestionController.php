<?php

namespace PFE\V3\MobSurveyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use PFE\V3\MobSurveyBundle\Entity\Question;
use PFE\V3\MobSurveyBundle\Entity\Choix;
use PFE\V3\MobSurveyBundle\Form\QuestionType;

/**
 * Question controller.
 *
 * @Route("/question")
 */
class QuestionController extends Controller
{
    /**
     * Lists all Question entities.
     *
     * @Route("/", name="question")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MSBundle:Question')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Question entity.
     *
     * @Route("/", name="question_create")
     * @Method("POST")
     * @Template("MSBundle:Question:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Question();
        $form = $this->createForm(new QuestionType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('question_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Question entity.
     *
     * @Route("/new", name="question_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Question();
        $form   = $this->createForm(new QuestionType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Question entity.
     *
     * @Route("/{id}", name="question_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MSBundle:Question')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Question entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Question entity.
     *
     * @Route("/{id}/edit", name="question_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MSBundle:Question')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Question entity.');
        }

        $editForm = $this->createForm(new QuestionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Question entity.
     *
     * @Route("/{id}", name="question_update")
     * @Method("PUT")
     * @Template("MSBundle:Question:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MSBundle:Question')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Question entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new QuestionType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('question_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Question entity.
     *
     * @Route("/{id}", name="question_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MSBundle:Question')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Question entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('question'));
    }

    /**
     * Creates a form to delete a Question entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }


    private $newQuestionnaire;

    /**
     * Creates a new Question entity.
     *
     * @Route("/create", name="question_create")
     * @Method("POST")
     * @Template("MSBundle:Question:new.html.twig")
     */
    public function createServiceAction(Request $request)
    {
//        $entity  = new Question();
//        $form = $this->createForm(new QuestionType(), $entity);
//        $form->bind($request);
//
//        if ($form->isValid()) {

//    try{
//
//          $id= intval($request->get("id"));
//          $texte= $request->get("texte");
//          $obligaoitre=intval( $request->get("obligaoitre") );
//          $questionSuivante= $request->get("questionSuivante");
//          $qtype= $request->get("qtype");
//          $questionnaire= $request->get("questionnaire");
//
//
//        }
//        catch( \Symfony\Component\Config\Definition\Exception\Exception $ex){
//            echo "EException";
//        }

//            $em = $this->getDoctrine()->getManager();
//            $em->persist($entity);
//            $em->flush();

            //return $this->redirect($this->generateUrl('question_show', array('id' => $entity->getId())));



//         $question =  $request->get("question");
//
//        echo $this->QuestionToString($question);
        /*****************************/

        $this->newQuestionnaire = new \Doctrine\Common\Collections\ArrayCollection();

        $question =  $request->get("question");


        $em = $this->getDoctrine()->getManager();
        $id_questionnaire = 1;
        if($request->get("questionnaire") != null)
            $id_questionnaire = intval($request->get("questionnaire"));

        $questionnaire = $em->getRepository("MSBundle:Questionnaire")->findOneById($id_questionnaire);
        $questionnaire->setPremiereQuestion($this->PersisterQuestion($question, $questionnaire));

        $em->flush();
        echo "Ok";
        die();

//        }

//        return array(
//            'entity' => $entity,
//            'form'   => $form->createView(),
//        );
    }

    private function QuestionToString($question){
        if(isset($question["suivant"]))return " id : ".$question["texte"]."<br /> ".$this->QuestionToString($question["suivant"]);
        return "id fin: ".$question["texte"];


    }

    private function PersisterQuestion( $jsonQuestion , $questionnaire )
    {
        if($this->newQuestionnaire->containsKey($jsonQuestion["id"]))
            return $this->newQuestionnaire[$jsonQuestion["id"]];

        $question = new Question();
        $question->setTexte($jsonQuestion["texte"]);
        $question->setObligatoire(($jsonQuestion["obligatoire"] == 0)? false:true);


        $em = $this->getDoctrine()->getManager();
        $qtype = $jsonQuestion["type"];
        $type = $em->getRepository("MSBundle:QType")->findOneByValeur($qtype);
        $question->setQType($type);
        $question->setQuestionnaire($questionnaire);

        //***********   Important
        $this->newQuestionnaire[$jsonQuestion["id"]] = $question;

        //** persister les choix  */


        if (isset($jsonQuestion["choix"]))
        {

            foreach ($jsonQuestion["choix"] as $e)
            {

                $this->persisterChoix($e, $question, $questionnaire);
            }
        }
        if (isset($jsonQuestion["suivant"]))
            $question->setQuestionSuivante($this->PersisterQuestion( $jsonQuestion["suivant"], $questionnaire));

        $em->persist($question);

        return $question;
    }

    private function persisterChoix( $JsonChoix , $question , $questionnaire)
    {
         $choix = new Choix();
        $choix->setValeur($JsonChoix["valeur"]);
        $choix->setChType("texte");
        $choix->setQuestion($question);

        if (isset($JsonChoix["attache"]))
            $choix->setAttachedQuestion($this->PersisterQuestion( $JsonChoix["attache"], $questionnaire));


        $em = $this->getDoctrine()->getManager();
        $em->persist($choix);
        return $choix;

    }
}
