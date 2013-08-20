<?php

namespace PFE\V3\MobSurveyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use PFE\V3\MobSurveyBundle\Entity\Campagne;
use PFE\V3\MobSurveyBundle\Form\CampagneType;

/**
 * Campagne controller.
 *
 * @Route("/campagne")
 */
class CampagneController extends Controller
{
    /**
     * Lists all Campagne entities.
     *
     * @Route("/", name="campagne")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MSBundle:Campagne')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Campagne entity.
     *
     * @Route("/", name="campagne_create")
     * @Method("POST")
     * @Template("MSBundle:Campagne:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Campagne();
        $form = $this->createForm(new CampagneType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('campagne_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Campagne entity.
     *
     * @Route("/new", name="campagne_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Campagne();
        $form   = $this->createForm(new CampagneType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Campagne entity.
     *
     * @Route("/{id}", name="campagne_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MSBundle:Campagne')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Campagne entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Campagne entity.
     *
     * @Route("/{id}/edit", name="campagne_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MSBundle:Campagne')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Campagne entity.');
        }

        $editForm = $this->createForm(new CampagneType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Campagne entity.
     *
     * @Route("/{id}", name="campagne_update")
     * @Method("PUT")
     * @Template("MSBundle:Campagne:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MSBundle:Campagne')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Campagne entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new CampagneType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('campagne_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Campagne entity.
     *
     * @Route("/{id}", name="campagne_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        //if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MSBundle:Campagne')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Campagne entity.');
            }

            $em->remove($entity);
            $em->flush();
        //}

        return $this->redirect($this->generateUrl('campagne'));
    }

    /**
     * Creates a form to delete a Campagne entity by id.
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
