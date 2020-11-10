<?php
    include_once('MessengerBot.php');
    class ViberBot extends MessengerBot{
        public function __construct($token, $api_url = 'https://chatapi.viber.com/pa'){
            parent::__construct($token, $api_url);
        }

        public function sendRequest($method, $data){
            parent::sendRequest($method, json_encode($data));
        }
    }
?>