<?php

namespace PFE\V3\MobSurveyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use PFE\V3\MobSurveyBundle\Entity\Questionnaire;
use PFE\V3\MobSurveyBundle\Form\QuestionnaireType;

/**
 * Questionnaire controller.
 *
 * @Route("/questionnaire")
 */
class QuestionnaireController extends Controller
{
    /**
     * Lists all Questionnaire entities.
     *
     * @Route("/", name="questionnaire")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MSBundle:Questionnaire')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Questionnaire entity.
     *
     * @Route("/", name="questionnaire_create")
     * @Method("POST")
     * @Template("MSBundle:Questionnaire:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Questionnaire();
        $form = $this->createForm(new QuestionnaireType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('questionnaire_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Questionnaire entity.
     *
     * @Route("/new", name="questionnaire_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Questionnaire();
        $form   = $this->createForm(new QuestionnaireType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Questionnaire entity.
     *
     * @Route("/{id}", name="questionnaire_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MSBundle:Questionnaire')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Questionnaire entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Questionnaire entity.
     *
     * @Route("/{id}/edit", name="questionnaire_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MSBundle:Questionnaire')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Questionnaire entity.');
        }

        $editForm = $this->createForm(new QuestionnaireType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Questionnaire entity.
     *
     * @Route("/{id}", name="questionnaire_update")
     * @Method("PUT")
     * @Template("MSBundle:Questionnaire:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MSBundle:Questionnaire')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Questionnaire entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new QuestionnaireType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('questionnaire_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Questionnaire entity.
     *
     * @Route("/{id}", name="questionnaire_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MSBundle:Questionnaire')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Questionnaire entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('questionnaire'));
    }

    /**
     * Creates a form to delete a Questionnaire entity by id.
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
}
