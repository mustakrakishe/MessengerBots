<?php
    include_once('MessengerBot.php');
    class ViberBot extends MessengerBot{
        protected $name = null;
        protected $senderNameMaxLength = 28;

        public function __construct($token, $api_url = 'https://chatapi.viber.com/pa'){
            parent::__construct($token, $api_url);
            $this->METHOD_PARAMETER_NAMES = [
                'sendMessage' => [
                    'methodName' => 'send_message',
                    'receiver' => 'receiver',
                    'image' => 'media',
                    'imageDescription' => 'text'
                ],

                'getAccountInfo' => [
                    'methodName' => 'get_account_info'
                ]
            ];
        }

        public function setName($name){
            if($this->senderNameValidation($name)){
                $this->name = $name;
            }
            
            return $this->name;
        }

        protected function senderNameValidation($name){
            return is_string($name) && strlen($name) <= $this->senderNameMaxLength;
        }

        public function getName($name){
            return $this->name;
        }

        public function sendRequest($method, $options = []){
            $options[CURLOPT_HTTPHEADER] = ['X-Viber-Auth-Token: ' . $this->TOKEN];
            if(isset($options[CURLOPT_POSTFIELDS])){
                $options[CURLOPT_POSTFIELDS] = json_encode($options[CURLOPT_POSTFIELDS]);
            }
            return parent::sendRequest($method, $options);
        }

        protected function sendMessage($receiver, $message){
            if($this->senderNameValidation($this->name)){
                $message['sender']['name'] = $this->name;
            }
            parent::sendMessage($receiver, $message);
        }

        protected function makeTextMessage($text, $message = null){
            $message['type'] = 'text';
            return parent::makeTextMessage($text, $message);
        }

        protected function makeImageMessage($image, $description = null, $message = null){
            $message['type'] = 'picture';
            return parent::makeImageMessage($image, $description, $message);
        }

        public function getAccountInfo(){
            $method = $this->KEY_WORDS['methodNames']['getAccountInfo'];
            return $this->sendRequest($method);
        }    
    }
?>