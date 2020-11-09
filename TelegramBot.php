<?php
    class TelegramBot{
        protected $TOKEN;
        protected $API_URL;

        public function __construct($token, $api_url = 'https://api.telegram.org'){
            $this->TOKEN = $token;
            $this->API_URL = $api_url;
        }

        public function sendRequest($method, $data){
            $url_pieces = [
                $this->API_URL,
                'bot' . $this->TOKEN,
                $method
            ];
            $url = implode('/', $url_pieces);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            $res = curl_exec($ch);
            
            if(curl_error($ch)){
                return curl_error($ch);
            }
            else{
                return json_decode($res);
            }
        }

        public function sendMessage($chatId, $message){
            $method = 'sendmessage';
            $data = $message;
            $data['chat_id'] = $chatId;
            
            $this->sendRequest($method, $data);
        }

        public function sendText($chatId, $text){
            $message['text'] = $text;
            $this->sendMessage($chatId, $message);
        }
    }


?>