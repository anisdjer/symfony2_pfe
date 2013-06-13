<?php

namespace PFE\V3\MobSurveyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use PFE\V3\MobSurveyBundle\Entity\Choix;
use PFE\V3\MobSurveyBundle\Form\ChoixType;

/**
 * Choix controller.
 *
 * @Route("/choix")
 */
class ChoixController extends Controller
{
    /**
     * Lists all Choix entities.
     *
     * @Route("/", name="choix")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MSBundle:Choix')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Choix entity.
     *
     * @Route("/", name="choix_create")
     * @Method("POST")
     * @Template("MSBundle:Choix:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Choix();
        $form = $this->createForm(new ChoixType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('choix_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Choix entity.
     *
     * @Route("/new", name="choix_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Choix();
        $form   = $this->createForm(new ChoixType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Choix entity.
     *
     * @Route("/{id}", name="choix_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MSBundle:Choix')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Choix entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Choix entity.
     *
     * @Route("/{id}/edit", name="choix_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MSBundle:Choix')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Choix entity.');
        }

        $editForm = $this->createForm(new ChoixType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Choix entity.
     *
     * @Route("/{id}", name="choix_update")
     * @Method("PUT")
     * @Template("MSBundle:Choix:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MSBundle:Choix')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Choix entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ChoixType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('choix_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Choix entity.
     *
     * @Route("/{id}", name="choix_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MSBundle:Choix')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Choix entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('choix'));
    }

    /**
     * Creates a form to delete a Choix entity by id.
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
