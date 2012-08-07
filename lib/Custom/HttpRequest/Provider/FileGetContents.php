<?php

namespace Custom\HttpRequest\Provider;

use Custom\HttpRequest\BaseRequest;
use Custom\HttpRequest\ProviderInterface;

class FileGetContents extends BaseRequest implements ProviderInterface {

    private $_context;

    public function before() {
        $this->_context = array(
            'http' => array(
                'method'  => $this->_method,
            )
        );

        $methods = array('POST', 'PUT');
        if(in_array($this->_method, $methods) && $this->_data) {
            $this->_context['http']['content'] = $this->_data;
        }
    }

    public function run() {
        $headers = array();
        foreach($this->_headers as $header => $value) {
            $headers[] = $header.': '.$value;
        }

        $this->_context['http']['header'] = $headers;

        if($this->_context) {
            $context = stream_context_create($this->_context);
            $this->_result = file_get_contents($this->_url, false, $context);
        } else {
            $this->_result = file_get_contents($this->_url);
        }
    }

}
