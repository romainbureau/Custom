<?php

namespace Custom\HttpRequest\Provider;

use Custom\HttpRequest\BaseRequest;
use Custom\HttpRequest\ProviderInterface;

class Curl extends BaseRequest implements ProviderInterface
{
    private static $_curl;
    private $_options = array();

    public function setOptions()
    {
        $options = array(
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS => 3,
            CURLOPT_CONNECTTIMEOUT => 30,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        );

        switch ($this->_method) {
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

    public function before()
    {
        self::$_curl = curl_init();
        $this->setOptions();
    }

    public function run()
    {
        $headers = array();
        foreach ($this->_headers as $header => $value) {
            $headers[] = $header.': '.$value;
        }

        curl_setopt(self::$_curl, CURLOPT_URL, $this->_url);
        curl_setopt(self::$_curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt_array(self::$_curl, $this->_options);

        $this->_result = curl_exec(self::$_curl);
    }

    public function after()
    {
        curl_close(self::$_curl);
    }

}
