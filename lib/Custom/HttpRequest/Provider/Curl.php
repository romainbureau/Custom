<?php

namespace Custom\HttpRequest\Provider;

use Custom\HttpRequest\BaseRequest;
use Custom\HttpRequest\ProviderInterface;

class Curl extends BaseRequest implements ProviderInterface {

    static private $_curl;
    private $options = array();

    public function setOptions() {
        $options = array(
            CURLOPT_HTTPHEADER => $this->_headers,
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS => 3,
            CURLOPT_CONNECTTIMEOUT => 30,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        );

        switch($this->_method) {
        case 'GET':
            break;
        case 'POST':
            $options[CURLOPT_POST] = true;
            $options[CURLOPT_POSTFIELDS] = $this->_data;
            break;
        case 'PUT':
            $options[CURLOPT_CUSTOMREQUEST] = 'PUT'; 
            $options[CURLOPT_POSTFIELDS] = $this->_data;
            break;
        case 'DELETE':
            $options[CURLOPT_CUSTOMREQUEST] = 'DELETE'; 
            break;
        }

        $this->_options = $options;
    }

    public function mergeOptions(array $array = array()) {
        $this->_options = array_merge($this->_options, $array);
    }

    public function before() {
        self::$_curl = curl_init(); 
        $this->setOptions();
    }


    public function run() {
        curl_setopt(self::$_curl, CURLOPT_URL, $this->_url);
        curl_setopt_array(self::$_curl, $this->_options);
        $this->_result = curl_exec(self::$_curl);
    }

    public function after() {
        curl_close(self::$_curl);
    }

}
