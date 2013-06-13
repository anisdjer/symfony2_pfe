<?php

namespace PFE\V3\MobSurveyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use PFE\V3\MobSurveyBundle\Entity\Enquete;
use PFE\V3\MobSurveyBundle\Form\EnqueteType;

/**
 * Enquete controller.
 *
 * @Route("/enquete")
 */
class EnqueteController extends Controller
{
    /**
     * Lists all Enquete entities.
     *
     * @Route("/", name="enquete")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MSBundle:Enquete')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Enquete entity.
     *
     * @Route("/", name="enquete_create")
     * @Method("POST")
     * @Template("MSBundle:Enquete:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Enquete();
        $form = $this->createForm(new EnqueteType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {

            foreach($entity->getEquipes() as $eq)
            {
                $eq->addEnquete($entity);
            }

            $em = $this->getDoctrine()->getManager();

            $em->persist($entity);

            $em->flush();
            // Notifier les utilisateurs concernés.
//            $equipes = $entity->getEquipes();
//            $enqueteurs = array();
//            $superviseurs = array();
//////
//            foreach($equipes as $equipe)
//            {
//                $superviseurs[] = $equipe->getSuperviseur();
//
//                foreach($equipe->getEnqueteurs() as $enq)
//                {
//                    $enqueteurs[] = $enq;
//                }
////                $enqueteurs[] = array_merge($enqueteurs, $equipe->getEnqueteurs());
////                $superviseurs = array_merge((array)$superviseurs, (array) $equipe->getSuperviseur());
//            }
//            $enqueteurs = array_unique($enqueteurs);
//            $superviseurs = array_unique($superviseurs);
//
//            foreach($enqueteurs as $eq)
//            {
//                $eq->notify("Nouvelle enquete");
//            }

            return $this->redirect($this->generateUrl('enquete_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Enquete entity.
     *
     * @Route("/new", name="enquete_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Enquete();
        $form   = $this->createForm(new EnqueteType(), $entity);
        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Enquete entity.
     *
     * @Route("/{id}", name="enquete_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MSBundle:Enquete')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Enquete entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Enquete entity.
     *
     * @Route("/{id}/edit", name="enquete_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MSBundle:Enquete')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Enquete entity.');
        }

        $editForm = $this->createForm(new EnqueteType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Enquete entity.
     *
     * @Route("/{id}", name="enquete_update")
     * @Method("PUT")
     * @Template("MSBundle:Enquete:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MSBundle:Enquete')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Enquete entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new EnqueteType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {

            $equipes = $em->getRepository('MSBundle:Equipe')->findAll();
            foreach($equipes as $equi)
            {
                $equi->removeEnquete($entity);
            }

            foreach($entity->getEquipes() as $eq)
            {
                $eq->addEnquete($entity);
            }
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('enquete_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Enquete entity.
     *
     * @Route("/{id}", name="enquete_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
//        $form = $this->createDeleteForm($id);
//        $form->bind($request);
//
//        if ($form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('MSBundle:Enquete')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Enquete entity.');
        }

        $em->remove($entity);
        $em->flush();
//        }

        return $this->redirect($this->generateUrl('enquete'));
    }


    /**
     * Deletes a Enquete entity.
     *
     * @Route("/equipes/{dateDebut}/{dateFin}", name="enquete_equipes")
     * @Template("MSBundle:Enquete:equipes.html.twig")
     */
    public function equipesAction($dateDebut,$dateFin)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('MSBundle:Equipe')->findAll();
        $enqueteurs = array();
        $enqueteurEn = $em->getRepository('MSBundle:Enqueteur')->findAll();
        foreach($enqueteurEn as $enq)
        {
            if(! $enq->isOccupied(new \DateTime($dateDebut),new \DateTime($dateFin)))
                $enqueteurs[] = $enq;
        }
        $superviseurs = array();
        $superviseursEn = $em->getRepository('MSBundle:Superviseur')->findAll();
        foreach($superviseursEn as $sp)
        {
            if(! $sp->isOccupied(new \DateTime($dateDebut),new \DateTime($dateFin)))
                $superviseurs[] = $sp;
        }

        return
            array(
                "superviseurs"   => $superviseurs,
                "enqueteurs"   => $enqueteurs,
                "dateDebut" => strtotime($dateDebut),
                "dateFin"   => strtotime($dateFin)
        );
    }

    /**
     * Creates a form to delete a Enquete entity by id.
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
