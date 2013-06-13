<?php

namespace PFE\V3\MobSurveyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use PFE\V3\MobSurveyBundle\Entity\Superviseur;
use PFE\V3\MobSurveyBundle\Form\SuperviseurType;

/**
 * Superviseur controller.
 *
 * @Route("/users/superviseur")
 */
class SuperviseurController extends Controller
{
    /**
     * Lists all Superviseur entities.
     *
     * @Route("/", name="users_superviseur")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MSBundle:Superviseur')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Superviseur entity.
     *
     * @Route("/", name="users_superviseur_create")
     * @Method("POST")
     * @Template("MSBundle:Superviseur:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Superviseur();
        $form = $this->createForm(new SuperviseurType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('users_superviseur_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Superviseur entity.
     *
     * @Route("/new", name="users_superviseur_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Superviseur();
        $form   = $this->createForm(new SuperviseurType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Superviseur entity.
     *
     * @Route("/{id}", name="users_superviseur_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MSBundle:Superviseur')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Superviseur entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Superviseur entity.
     *
     * @Route("/{id}/edit", name="users_superviseur_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MSBundle:Superviseur')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Superviseur entity.');
        }

        $editForm = $this->createForm(new SuperviseurType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Superviseur entity.
     *
     * @Route("/{id}", name="users_superviseur_update")
     * @Method("PUT")
     * @Template("MSBundle:Superviseur:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MSBundle:Superviseur')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Superviseur entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new SuperviseurType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('users_superviseur_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Superviseur entity.
     *
     * @Route("/{id}", name="users_superviseur_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MSBundle:Superviseur')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Superviseur entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('users_superviseur'));
    }

    /**
     * Creates a form to delete a Superviseur entity by id.
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
