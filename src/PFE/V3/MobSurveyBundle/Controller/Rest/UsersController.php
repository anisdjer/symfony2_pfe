<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anonyme
 * Date: 28/02/13
 * Time: 20:47
 * To change this template use File | Settings | File Templates.
 */



namespace PFE\V3\MobSurveyBundle\Controller\Rest;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;

class UsersController extends FOSRestController
{
    /**
     * @Rest\Options
     */
    public function optionsUsersAction()
    {} // "options_users" [OPTIONS] /users


    public function getUsersAction()
    {
//        echo "here";die();

        $service = $this->get("my_service");
        $view = $this->view(
            array(
                'users' => $service->test(1)
            )
        )
        ;

        return $this->handleView($view);
    } // "get_users"     [GET] /users

    public function newUsersAction()
    {
        $id = $this->getRequest()->query->get("id");
        $user = "USER";
        $view = $this->view(array('users' => "Get newUser",$user => $id))
        ;

        return $this->handleView($view);
    } // "new_users"     [GET] /users/new

    public function postUsersAction()
    {
        $view = $this->view(array('users' => "post"))
        ;

        return $this->handleView($view);
    } // "post_users"    [POST] /users

    public function patchUsersAction()
    {} // "patch_users"   [PATCH] /users

    public function getUserAction($slug)
    {} // "get_user"      [GET] /users/{slug}

    public function editUserAction($slug)
    {} // "edit_user"     [GET] /users/{slug}/edit

    public function putUserAction($slug)
    {} // "put_user"      [PUT] /users/{slug}

    public function patchUserAction($slug)
    {} // "patch_user"    [PATCH] /users/{slug}

    public function lockUserAction($slug)
    {} // "lock_user"     [PATCH] /users/{slug}/lock

    public function banUserAction($slug)
    {} // "ban_user"      [PATCH] /users/{slug}/ban

    public function removeUserAction($slug)
    {
        $view = $this->view(array('users' => $slug))
        ;

        return $this->handleView($view);
    } // "remove_user"   [GET] /users/{slug}/remove

    public function deleteUserAction($slug)
    {} // "delete_user"   [DELETE] /users/{slug}

    public function getUserCommentsAction($slug)
    {} // "get_user_comments"    [GET] /users/{slug}/comments

    public function newUserCommentsAction($slug)
    {} // "new_user_comments"    [GET] /users/{slug}/comments/new

    public function postUserCommentsAction($slug)
    {} // "post_user_comments"   [POST] /users/{slug}/comments

    public function getUserCommentAction($slug, $id)
    {} // "get_user_comment"     [GET] /users/{slug}/comments/{id}

    public function editUserCommentAction($slug, $id)
    {} // "edit_user_comment"    [GET] /users/{slug}/comments/{id}/edit

    public function putUserCommentAction($slug, $id)
    {} // "put_user_comment"     [PUT] /users/{slug}/comments/{id}

    public function postUserCommentVoteAction($slug, $id)
    {} // "post_user_comment_vote" [POST] /users/{slug}/comments/{id}/vote

    public function removeUserCommentAction($slug, $id)
    {} // "remove_user_comment"  [GET] /users/{slug}/comments/{id}/remove

    public function deleteUserCommentAction($slug, $id)
    {} // "delete_user_comment"  [DELETE] /users/{slug}/comments/{id}

    public function linkUserAction($slug)
    {} // "link_user_friend"     [LINK] /users/{slug}

    public function unlinkUserAction($slug)
    {} // "link_user_friend"     [UNLINK] /users/{slug}


    public function getUserCommentTestsAction($slug, $id)
    {
        $view = $this->view(array('users Comment Test' => array("user" => $slug,"comment" => $id)))
        ;

        return $this->handleView($view);
    } // "get_user_comments"    [GET] /users/{slug}/comments/{id}/tests


}
