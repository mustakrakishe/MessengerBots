<?php
    include_once('MessengerBot.php');
    class TelegramBot extends MessengerBot{
        public function __construct($token, $api_url = 'https://api.telegram.org'){
            parent::__construct($token, $api_url);
            $this->KEY_WORDS = [
                'methodNames' => [
                    'sendMessage' => 'sendmessage'
                ],

                'requestDataKeys' => [
                    'receiverKey' => 'chat_id'
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