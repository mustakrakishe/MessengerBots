<?php
    include_once('MessengerBot.php');
    class TelegramBot extends MessengerBot{
        
        public function __construct($token, $apiUrl = 'https://api.telegram.org'){
            parent::__construct($token, $apiUrl);
            $this->API_URL = $apiUrl . '/bot' . $token;
        }

        public function sendText($receiver, $text){
            $options[CURLOPT_URL] = $this->API_URL . '/sendMessage';
            $options[CURLOPT_POSTFIELDS] = [
                'chat_id' => $receiver,
                'text' => $text
            ];
            return $this->sendRequest($options);
        }

        public function sendImage($receiver, $image, $caption = null){
            $options[CURLOPT_URL] = $this->API_URL . '/sendPhoto';
            $options[CURLOPT_POSTFIELDS] = [
                'chat_id' => $receiver,
                'photo' => curl_file_create($image)
            ];
            if(isset($caption)){
                $options[CURLOPT_POSTFIELDS]['caption'] = $caption;
            }
            return $this->sendRequest($options);
        }
    }
?>