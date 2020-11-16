<?php
    include_once('MessengerBot.php');
    class ViberBot extends MessengerBot{
        protected $TOKEN_HTTPHEADER;
        protected $name = null;
        protected $senderNameMaxLength = 28;

        public function __construct($token, $apiUrl = 'https://chatapi.viber.com/pa'){
            $this->API_URL = $apiUrl;
            $this->TOKEN_HTTPHEADER = ['X-Viber-Auth-Token: ' . $token];
        }

        protected function sendRequest($options){
            $options[CURLOPT_HTTPHEADER] = $this->TOKEN_HTTPHEADER;
            if(isset($options[CURLOPT_POSTFIELDS])){
                $options[CURLOPT_POSTFIELDS] = json_encode($options[CURLOPT_POSTFIELDS]);
            }
            return parent::sendRequest($options);
        }

        public function sendText($receiver, $text){
            $options[CURLOPT_URL] = $this->API_URL . '/send_message';
            $options[CURLOPT_POSTFIELDS] = [
                'receiver' => $receiver,
                'type' => 'text',
                'text' => $text
            ];
            if(isset($this->name)){
                $options[CURLOPT_POSTFIELDS]['sender']['name'] = $this->name;
            }
            return $this->sendRequest($options);
        }

        public function sendImage($receiver, $image, $caption = null){
            $options[CURLOPT_URL] = $this->API_URL . '/send_message';
            $options[CURLOPT_POSTFIELDS] = [
                'receiver' => $receiver,
                'type' => 'picture',
                'media' => $image
            ];
            if(isset($caption)){
                $options[CURLOPT_POSTFIELDS]['text'] = $caption;
            }
            if(isset($this->name)){
                $options[CURLOPT_POSTFIELDS]['sender']['name'] = $this->name;
            }
            return $this->sendRequest($options);
        }

        public function setName($name){
            if($this->senderNameValidation($name)){
                return $this->name = $name;
            }
        }

        protected function senderNameValidation($name){
            return is_string($name) && strlen($name) <= $this->senderNameMaxLength;
        }

        public function getName(){
            return $this->name;
        }

        public function getAccountInfo(){
            $options[CURLOPT_URL] = $this->API_URL . '/get_account_info';
            return $this->sendRequest($options);
        }    
    }
?>