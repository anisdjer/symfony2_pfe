<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anonymous
 * Date: 17/03/13
 * Time: 20:13
 * To change this template use File | Settings | File Templates.
 */

namespace PFE\V3\MobSurveyBundle\Controller\Rest;

use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use PFE\V3\MobSurveyBundle\Utils\GCM\GCMPushMessage;




/**
 * @Route("/security")
 */
class Security extends FOSRestController
{

    /**
     * @Route("/login" , name="login_mob", defaults={"_format"="json"})
     * @Method("POST")
     */
    public function loginAction()
    {
        $status = 403;
        //$enqueteur = new \PFE\V2\MOBSurveyBundle\Entity\Enqueteur();



        try{
            $mail = $this->getRequest()->getUser();
            $password = $this->getRequest()->getPassword();

            $em = $this->getDoctrine()->getEntityManager();
            $enqueteur = $em->getRepository("MSBundle:Enqueteur")->findOneByEmail($mail);

            if(!empty($enqueteur) ){
                if($enqueteur->getPassword()== $password){

                    /*$latitude = $this->getRequest()->get("latitude");
                    $longitude = $this->getRequest()->get("longitude");*/

                   /* $geo = new \PFE\V3\MobSurveyBundle\Entity\GeoLocalisation();

                    $geo->setUser($enqueteur);
                    $geo->setLatitude($latitude);
                    $geo->setLongitude($longitude);
                    $geo->setDateLocalisation(new \DateTime("now"));
                    $em->persist($geo);*/

                    // TODO : enqueteur->setDevice($device_id);
                    //$enqueteur->setDevice($device);
                    //$em->persist($enqueteur);
                    $em->flush();
//                    $apiKey = "AIzaSyCj0lBAhSM0PCNW0QnffNymTRcbKRV7ltk";
//                    $devices = array('APA91bF0uEhHPcT5shSIL4FKvgTyybMWxNzsRBWLEQXNUhsKfcK42TLavyw-dqC8XWImCvH_A_QCM0HzNYq3k5dprSnGTUKJkxvKqTa9GEuaj-eydAZMEfkRlFhoINToGhBwo8bw3trg');
//                    $message = "The message to send";


//                    $reg_id1 = "APA91bF0uEhHPcT5shSIL4FKvgTyybMWxNzsRBWLEQXNUhsKfcK42TLavyw-dqC8XWImCvH_A_QCM0HzNYq3k5dprSnGTUKJkxvKqTa9GEuaj-eydAZMEfkRlFhoINToGhBwo8bw3trg";
//                    $reg_id2 = "APA91bELAzHfaonosU39JDf0P1k_Sifs3Mj4WnHNEpvp8DM7nXrAGyrdDWgCPlMLIZAZ87ZiEzo4g_vQ7E5yZcxbuyZA_sXAWFJN-fkc7uuT_F2hi18rVFRN0ODpXg05o91GlfL6a_vFVxtSdsBTGOcYKsDVWokmww";
//                    $reg_ids = array($reg_id1, $reg_id2);
//                    $msg = "Google Cloud Messaging working well";
//
//                    $this->send_gcm_notify($reg_ids, $msg);


                    $status = 200;
                    $view = $this->view($enqueteur->serialize())
                    ;
                    return $this->handleView($view, $status);
                }
            }

        }catch (\Symfony\Component\Config\Definition\Exception\Exception $ex){}

        $view = $this->view(array(),$status)
        ;

        return $this->handleView($view);


    }

    /**
     * @Route("/login/register" , name="register_mob", defaults={"_format"="json"})
     * @Method("POST")
     */
    public function registerAction()
    {
        try{
            $device = $this->getRequest()->get("device");
            $id = $this->getRequest()->get("id");

            $em = $this->getDoctrine()->getEntityManager();
            $enqueteur = $em->getRepository("MSBundle:Enqueteur")->findOneById($id);

            $enqueteur->setDevice($device);

            $em->persist($enqueteur);
            $em->flush();


            $status = 200;
            $view = $this->view(array())
            ;
            return $this->handleView($view, $status);
        }
        catch(\Symfony\Component\Config\Definition\Exception\Exception $e)
        {
            $status = 404;
            $view = $this->view(array())
            ;
            return $this->handleView($view, $status);

        }

    }

    /**
     * @Route("/login/unregister" , name="unregister_mob", defaults={"_format"="json"})
     * @Method("POST")
     */
    public function unregisterAction()
    {
        $status = 200;
        $view = $this->view(array())
        ;
        return $this->handleView($view, $status);
    }

    function send_gcm_notify($reg_ids, $message) {

        $fields = array(
            'registration_ids'  => $reg_ids,
            'data'              => array( "message" => $message ),
        );

        $headers = array(
            'Authorization: key=' . GOOGLE_API_KEY,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, GOOGLE_GCM_URL);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Problem occurred: ' . curl_error($ch));
        }

        curl_close($ch);
    }

}
