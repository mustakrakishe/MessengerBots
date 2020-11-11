<?php
    include_once('MessengerBot.php');
    class ViberBot extends MessengerBot{
        protected $name = null;
        protected $senderNameMaxLength = 28;

        public function __construct($token, $api_url = 'https://chatapi.viber.com/pa'){
            parent::__construct($token, $api_url);
            $this->KEY_WORDS = [
                'methodNames' => [
                    'sendMessage' => 'send_message',
                    'getAccountInfo' => 'get_account_info'
                ],

                'requestDataKeys' => [
                    'receiverKey' => 'receiver'
                ]
            ];
            $this->name = $this->getAccountInfo()->name;
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
            if(empty($message['sender']['name'])){
                if($this->senderNameValidation($this->name)){
                    $message['sender']['name'] = $this->name;
                }
            }
            parent::sendMessage($receiver, $message);
        }

        public function sendText($receiver, $text, $senderName = null){
            if($this->senderNameValidation($senderName)){
                $message['sender']['name'] = $senderName;
            }
            $message['text'] = $text;
            $message['type'] = 'text';
            $this->sendMessage($receiver, $message, $senderName);
        }

        public function getAccountInfo(){
            $method = $this->KEY_WORDS['methodNames']['getAccountInfo'];
            return $this->sendRequest($method);
        }    
    }

    
?>