<?php
include_once('MessengerBot.php');
    class TelegramBot extends MessengerBot{
        public function __construct($token, $api_url = 'https://api.telegram.org'){
            parent::__construct($token, $api_url);
        }

        protected function buildRequestUrl($method){
            $url_pieces = [
                $this->API_URL,
                'bot' . $this->TOKEN,
                $method
            ];
            return implode('/', $url_pieces);
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