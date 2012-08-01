<?php

namespace Custom\HttpRequest\Provider;

use Custom\HttpRequest\BaseRequest;
use Custom\HttpRequest\ProviderInterface;

class FileGetContents extends BaseRequest implements ProviderInterface {
    
    private $_context;

    public function before() {
        $context = array(
            'http' => array(
                'method'  => $this->_method,
            )
        );

        $headers = array();
        $methods = array('POST', 'PUT');
        if(in_array($this->_method, $methods) && $this->_data) {
            $context['http']['content'] = $this->_data;
        }

        $this->_context = $context;
    }

    public function mergeHeaders(array $array) {
        $this->_headers = array_merge($this->_headers, $array);
    }

    public function run() {
        $context['http']['header'] = $this->_headers;

        if($this->_context) 
            $this->_result = file_get_contents($this->_url, false, stream_context_create($this->_context));
        else
            $this->_result = file_get_contents($this->_url); 
    }

}
