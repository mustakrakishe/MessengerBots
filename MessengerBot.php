<?php
    interface iMessengerBot{
        function sendText($receiver, $text);
        function sendImage($receiver, $image, $caption = null);
    }

    abstract class MessengerBot implements iMessengerBot{
        protected $API_URL;

        public function __construct($token, $apiUrl = null){
        }

        protected function sendRequest($options){
            $options[CURLOPT_RETURNTRANSFER] = true;
            $ch = curl_init();
            curl_setopt_array($ch, $options);
            $res = curl_exec($ch);
            curl_close($ch);

            return json_decode($res);
        }
    }
?>