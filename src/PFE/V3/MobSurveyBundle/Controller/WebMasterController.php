<?php

namespace PFE\V3\MobSurveyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use PFE\V3\MobSurveyBundle\Entity\WebMaster;
use PFE\V3\MobSurveyBundle\Form\WebMasterType;

/**
 * WebMaster controller.
 *
 * @Route("/users/webmaster")
 */
class WebMasterController extends Controller
{
    /**
     * Lists all WebMaster entities.
     *
     * @Route("/", name="users_webmaster")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MSBundle:WebMaster')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Lists all WebMaster entities.
     *
     * @Route("/accounts", name="users_accounts")
     * @Method("GET")
     */
    public function accountsAction(){
        $em = $this->getDoctrine()->getManager();

        $webmasters = $em->getRepository('MSBundle:WebMaster')->findAll();
        $leaders = $em->getRepository('MSBundle:ChefEnquete')->findAll();
        $supervisors = $em->getRepository('MSBundle:Superviseur')->findAll();
        $enqueteurs = $em->getRepository('MSBundle:Enqueteur')->findAll();

        return $this->render('MSBundle:WebMasterDomain:accounts.html.twig', array(
            'webmasters'    => $webmasters,
            'leaders'       => $leaders,
            'supervisors'   => $supervisors,
            'enqueteurs'    => $enqueteurs,
        ));
    }


    /**
     * Creates a new WebMaster entity.
     *
     * @Route("/", name="users_webmaster_create")
     * @Method("POST")
     * @Template("MSBundle:WebMaster:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new WebMaster();
        $form = $this->createForm(new WebMasterType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $group = $em->getRepository("MSBundle:Groupe")->findOneByName("wabmaster");
            $entity->setEnabled(true);
            $entity->addRole("ROLE_USER");
            $entity->addGroup($group);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('users_webmaster', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new WebMaster entity.
     *
     * @Route("/new", name="users_webmaster_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new WebMaster();
        $form   = $this->createForm(new WebMasterType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a WebMaster entity.
     *
     * @Route("/{id}", name="users_webmaster_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MSBundle:WebMaster')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find WebMaster entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing WebMaster entity.
     *
     * @Route("/{id}/edit", name="users_webmaster_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MSBundle:WebMaster')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find WebMaster entity.');
        }

        $editForm = $this->createForm(new WebMasterType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing WebMaster entity.
     *
     * @Route("/{id}", name="users_webmaster_update")
     * @Method("PUT")
     * @Template("MSBundle:WebMaster:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MSBundle:WebMaster')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find WebMaster entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new WebMasterType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('users_webmaster_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a WebMaster entity.
     *
     * @Route("/{id}", name="users_webmaster_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
//        $form = $this->createDeleteForm($id);
//        $form->bind($request);

//        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MSBundle:WebMaster')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find WebMaster entity.');
            }

            $em->remove($entity);
            $em->flush();
//        }

        return $this->redirect($this->generateUrl('users_webmaster'));
    }

    /**
     * Creates a form to delete a WebMaster entity by id.
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
