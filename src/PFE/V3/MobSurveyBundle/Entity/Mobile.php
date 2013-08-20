<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anis
 * Date: 16/05/13
 * Time: 04:17
 * To change this template use File | Settings | File Templates.
 */

namespace PFE\V3\MobSurveyBundle\Entity;


use Doctrine\ORM\Mapping as ORM;



abstract class Mobile extends Utilisateur
{

    /**
     * @var integer
     *
     * @ORM\Column(name="device_id", type="text" , nullable=true)
     */
    protected $device_id;

    /**
     *
     * @ORM\OneToMany(targetEntity="PFE\V3\MobSurveyBundle\Entity\GeoLocalisation", orphanRemoval=true, mappedBy="user")
     */
    protected $geo;

    public function getDevice()
    {
        return $this->device_id;
    }
    public function setDevice( $device )
    {
        $this->device_id = $device;
    }


    public function serialize(){
        return array(
            "id" => $this->getId(),
            "name" => $this->getUsername(),
            "email" => $this->getEmail(),
            "photo" => "web/".$this->getWebPath()
        );
    }
    function notify($message)
    {
        try{
            $GOOGLE_API_KEY = "AIzaSyDfv7_L3qeGpjbDp5l2FS53zIYTl0q6zug";
            $GOOGLE_GCM_URL = "https://android.googleapis.com/gcm/send";
            $fields = array(
                'registration_ids'  => array($this->device_id),
                'data'              => array( "message" => $message ),
            );

            $headers = array(
                'Authorization: key=' . $GOOGLE_API_KEY,
                'Content-Type: application/json'
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $GOOGLE_GCM_URL);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

            $result = curl_exec($ch);
            if ($result === FALSE) {
                return false;
            }

            curl_close($ch);

            return true;
        }
        catch(\Symfony\Component\Config\Definition\Exception\Exception $e){
            return false;
        }

    }

}
