<?php
/**
 * Created by JetBrains PhpStorm.
 * Enqueteur: Anonyme
 * Date: 28/02/13
 * Time: 20:47
 * To change this template use File | Settings | File Templates.
 */



namespace PFE\V3\MobSurveyBundle\Controller\Rest;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;

class EquipesController extends FOSRestController
{



    public function getEquipesAction()
    {
        $id = $this->getRequest()->query->get("id");
        if(empty($id))
            throw \Doctrine\ORM\EntityNotFoundException::entityManagerClosed("Id Not found !");

        $view = $this->view(array('Equipes' => "Ok"))
        ;

        return $this->handleView($view);
    } // "get_equipes"     [GET] /equipes

    public function newEquipesAction()
    {
        $id = $this->getRequest()->query->get("id");
        $equipe = "Equipe";
        $view = $this->view(array('Equipes' => "Get newEquipe",$equipe => $id))
        ;

        return $this->handleView($view);
    } // "new_equipes"     [GET] /equipes/new

    public function postEquipesAction()
    {
        $view = $this->view(array('Equipes' => "post"))
        ;

        return $this->handleView($view);
    } // "post_equipes"    [POST] /equipes

    public function patchEquipesAction()
    {} // "patch_equipes"   [PATCH] /equipes




    public function getEquipeAction($slug)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $equipe = $em->getRepository("MSBundle:Equipe")->findOneById($slug);
        $result = "Echec";
        if(! empty($equipe))
            $result = $equipe->getId();

        $view = $this->view(array('equipes' => $result));

        return $this->handleView($view);
    } // "get_equipe"      [GET] /equipes/{slug}





    public function editEquipeAction($slug)
    {} // "edit_equipe"     [GET] /equipes/{slug}/edit

    public function putEquipeAction($slug)
    {} // "put_equipe"      [PUT] /equipes/{slug}

    public function patchEquipeAction($slug)
    {} // "patch_equipe"    [PATCH] /equipes/{slug}

    public function lockEquipeAction($slug)
    {} // "lock_equipe"     [PATCH] /equipes/{slug}/lock

    public function banEquipeAction($slug)
    {} // "ban_equipe"      [PATCH] /equipes/{slug}/ban





    public function removeEquipeAction($slug)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $equipe = $em->getRepository("MSBundle:Equipe")->find($slug);
        $view = $this->view(array('equipes' => $equipe))
        ;

        return $this->handleView($view);
    } // "remove_equipe"   [GET] /equipes/{slug}/remove







    public function deleteEquipeAction($slug)
    {} // "delete_equipe"   [DELETE] /equipes/{slug}



    public function linkEquipeAction($slug)
    {} // "link_equipe_friend"     [LINK] /equipes/{slug}

    public function unlinkEquipeAction($slug)
    {} // "link_equipe_friend"     [UNLINK] /equipes/{slug}
}
