<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anonymous
 * Date: 05/05/13
 * Time: 00:46
 * To change this template use File | Settings | File Templates.
 */
namespace PFE\V3\MobSurveyBundle\Utils\GCM;

class GCMPushMessage
{

    var $url = 'https://android.googleapis.com/gcm/send';
    var $serverApiKey = "";
    var $devices = array();

    function GCMPushMessage($apiKeyIn){
        $this->serverApiKey = $apiKeyIn;
    }

    function setDevices($deviceIds){

        if(is_array($deviceIds)){
            $this->devices = $deviceIds;
        } else {
            $this->devices = array($deviceIds);
        }

    }

    function send($message){

        if(!is_array($this->devices) || count($this->devices) == 0){
            $this->error("No devices set");
        }

        if(strlen($this->serverApiKey) < 8){
            $this->error("Server API Key not set");
        }

        $fields = array(
            'registration_ids'  => $this->devices,
            'data'              => array( "message" => $message ),
        );

        $headers = array(
            'Authorization: key=' . $this->serverApiKey,
            'Content-Type: application/json'
        );

        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt( $ch, CURLOPT_URL, $this->url );

        curl_setopt( $ch, CURLOPT_POST, true );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

        curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );

        // Execute post
        $result = curl_exec($ch);

        // Close connection
        curl_close($ch);

        return $result;
    }

    function error($msg){
        echo "Android send notification failed with error:";
        echo "\t" . $msg;
        exit(1);
    }

}
