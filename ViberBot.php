<?php
    include_once('MessengerBot.php');
    class ViberBot extends MessengerBot{
        public function __construct($token, $api_url = 'https://chatapi.viber.com/pa'){
            parent::__construct($token, $api_url);
        }

        public function sendRequest($method, $data){
            parent::sendRequest($method, json_encode($data));
        }

        public function sendMessage($receiver, $message){
            $method = 'send_message';
            $data = $message;
            $data['receiver'] = $receiver;
            
            $this->sendRequest($method, $data);
        }

        public function sendText($receiver, $text, $senderName = 'MustaBot'){
            $message = [
                'auth_token' => $this->TOKEN,
                'text' => $text,
                'type' => 'text',
                'sender' => [
                    'name' => $senderName
                ]
            ];
            $this->sendMessage($receiver, $message);
        }
    }

    
?>