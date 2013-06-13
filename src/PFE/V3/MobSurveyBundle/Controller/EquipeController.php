<?php

namespace PFE\V3\MobSurveyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use PFE\V3\MobSurveyBundle\Entity\Equipe;
use PFE\V3\MobSurveyBundle\Form\EquipeType;

/**
 * Equipe controller.
 *
 * @Route("/equipe")
 */
class EquipeController extends Controller
{
    /**
     * Lists all Equipe entities.
     *
     * @Route("/", name="equipe")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MSBundle:Equipe')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Equipe entity.
     *
     * @Route("/", name="equipe_create")
     * @Method("POST")
     * @Template("MSBundle:Equipe:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Equipe();
        $form = $this->createForm(new EquipeType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('equipe_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Equipe entity.
     *
     * @Route("/new", name="equipe_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Equipe();
        $form   = $this->createForm(new EquipeType(), $entity);

        $em = $this->getDoctrine()->getManager();

        $superviseurs =  $em->getRepository('MSBundle:Superviseur')->findAll();
        $enqueteurs = $em->getRepository('MSBundle:Enqueteur')->findAll();

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            "superviseurs" => $superviseurs,
            "enqueteurs" => $enqueteurs,
        );
    }

    /**
     * Finds and displays a Equipe entity.
     *
     * @Route("/{id}", name="equipe_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MSBundle:Equipe')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Equipe entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Equipe entity.
     *
     * @Route("/{id}/edit", name="equipe_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MSBundle:Equipe')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Equipe entity.');
        }

        $editForm = $this->createForm(new EquipeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Equipe entity.
     *
     * @Route("/{id}", name="equipe_update")
     * @Method("PUT")
     * @Template("MSBundle:Equipe:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MSBundle:Equipe')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Equipe entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new EquipeType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('equipe_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Equipe entity.
     *
     * @Route("/{id}", name="equipe_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MSBundle:Equipe')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Equipe entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('equipe'));
    }

    /**
     * Creates a form to delete a Equipe entity by id.
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

//    /**
//     * Deletes a Equipe entity.
//     *
//     * @Route("/enquete/{id_enquete}", name="equipe_new_enquete")
//     * @Method("GET")
//     * @Template("MSBundle:Equipe:new.html.twig")
//     */
//    public function enqueteAction(Request $request, $id_enquete)
//    {
//        $em = $this->getDoctrine()->getManager();
//        $enquete = $em->getRepository('MSBundle:Enquete')->find($id_enquete);
//
//
//        $entity = new Equipe();
//        $form   = $this->createForm(new EquipeType(), $entity)->add('enquetes','hidden' , array('data' => array($enquete)));
//
//        return array(
//            'entity' => $entity,
//            'form'   => $form->createView(),
//        );
//
//    }

}
