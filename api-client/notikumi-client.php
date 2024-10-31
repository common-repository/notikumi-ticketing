<?php
class NotikumiClient {

    private $_env;

    public function __construct($env = "production") {
        $this->_env = $env;
    }

    private function getUrl($model) {
        return $this->getBaseUrl()."current/".$model;
    }

    private function getBaseURL() {
        if($this->_env == "local") {
            return "http://localhost:7788/";
        }
        else if($this->_env == "stage") {
            return "https://api2-test.notikumi.com/";
        }
        else if($this->_env == "production") {
            return "https://api2.notikumi.com/";
        }     
    }

    public function getEvents($request) {
        $url = $this->getUrl("event");
        $url .= '?'.build_query($request);
        //echo $url;

        $response = wp_remote_get( $url , array('headers' => array('Accept' => 'application/json')) );

        $auth_token = wp_remote_retrieve_header( $response, "x-auth-token" );
        $body = wp_remote_retrieve_body( $response);
        
        return json_decode($body);
    }

    public function getEvent($request) {
        if($request['event_id']) {
            $url = $this->getUrl("event/".$request['event_id']);
        }
        else if($request['session_slug']) {
            $url = $this->getUrl("event/session/slug/".$request['session_slug']);
        }

        unset($request['event_id'], $request['session_slug']);

        $url .= '?'.build_query($request);
        //echo $url;

        $response = wp_remote_get( $url );

        $auth_token = wp_remote_retrieve_header( $response, "x-auth-token" );
        
        $body = wp_remote_retrieve_body( $response);
        return json_decode($body);
    }

}
?>