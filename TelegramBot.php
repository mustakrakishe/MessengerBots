<?php
    include_once('MessengerBot.php');
    class TelegramBot extends MessengerBot{
        public function __construct($token, $api_url = 'https://api.telegram.org'){
            parent::__construct($token, $api_url);
            $this->METHOD_PARAMETER_NAMES = [
                'sendMessage' => [
                    'methodName' => 'sendmessage',
                    'receiver' => 'chat_id',
                    'image' => 'photo',
                    'imageDescription' => 'caption'
                ]
            ];
        }

        protected function buildRequestUrl($method){
            $url_pieces = [
                $this->API_URL,
                'bot' . $this->TOKEN,
                $method
            ];
            return implode('/', $url_pieces);
        }
    }
?>