<?php
    class TelegramBot{
        protected $TOKEN;
        protected $API_URL;
        protected $updates;

        public function __construct($token, $api_url = 'https://api.telegram.org'){
            $this->TOKEN = $token;
            $this->API_URL = $api_url;
        }

        public function sendText($chatId, $text){
            $method = 'sendmessage';
            $data = [
                'chat_id' => $chatId,
                'text' => $text
            ];

            sendData($method, $data);
        }

        public function sendData($method, $data){
            $url_pieces = [
                $this->API_URL,
                'bot' . $this->TOKEN,
                $method
            ];
            $url = implode('/', $url_pieces);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            $res = curl_exec($ch);
            
            if(curl_error($ch)){
                return curl_error($ch);
            }
            else{
                return json_decode($res);
            }

        }

        public function getUpdates(){
            $this->updates = json_decode(file_get_contents('php://input'));
        }
    }
?>