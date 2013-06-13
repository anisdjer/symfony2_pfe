<?php

namespace PFE\V3\MobSurveyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use PFE\V3\MobSurveyBundle\Entity\QType;
use PFE\V3\MobSurveyBundle\Form\QTypeType;

/**
 * QType controller.
 *
 * @Route("/qtype")
 */
class QTypeController extends Controller
{
    /**
     * Lists all QType entities.
     *
     * @Route("/", name="qtype")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MSBundle:QType')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new QType entity.
     *
     * @Route("/", name="qtype_create")
     * @Method("POST")
     * @Template("MSBundle:QType:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new QType();
        $form = $this->createForm(new QTypeType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('qtype_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new QType entity.
     *
     * @Route("/new", name="qtype_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new QType();
        $form   = $this->createForm(new QTypeType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a QType entity.
     *
     * @Route("/{id}", name="qtype_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MSBundle:QType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find QType entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing QType entity.
     *
     * @Route("/{id}/edit", name="qtype_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MSBundle:QType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find QType entity.');
        }

        $editForm = $this->createForm(new QTypeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing QType entity.
     *
     * @Route("/{id}", name="qtype_update")
     * @Method("PUT")
     * @Template("MSBundle:QType:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MSBundle:QType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find QType entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new QTypeType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('qtype_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a QType entity.
     *
     * @Route("/{id}", name="qtype_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MSBundle:QType')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find QType entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('qtype'));
    }

    /**
     * Creates a form to delete a QType entity by id.
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
