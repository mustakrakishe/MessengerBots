<?php
    class ViberBot{
        protected $TOKEN;
        protected $API_URL;
    
        public function __construct($token, $api_url = 'https://chatapi.viber.com/pa'){
            $this->TOKEN = $token;
            $this->API_URL = $api_url;
        }
    
        public function sendRequest($method, $data){
            $request_data = json_encode($data);
            $url_pieces = [
                $this->API_URL,
                $method
            ];
            $url = implode('/', $url_pieces);
    
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $request_data);
            curl_exec($ch);
        }
    }
?>