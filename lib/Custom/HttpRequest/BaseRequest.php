<?php

namespace Custom\HttpRequest;

abstract class BaseRequest {

    public $_url;
    protected $_auth;
    protected $_headers = array();
    protected $_data;
    protected $_method = 'GET';
    protected $_result;

    public function setUrl($url) {
        $this->_url = $url;
    }

    public function getUrl() {
        return $this->_url;
    }

    public function setAuth($auth) {
        $this->_auth = base64_encode($auth);
    }

    public function setHeaders(array $headers) {
        $this->_headers = $headers;
    }

    public function setData($data) {
        $this->_data = $data;
    }

    public function getData() {
        return $this->_data;
    }

    public function setMethod($method) {
        $methods = array('GET', 'POST', 'PUT', 'DELETE');
        if(!in_array($method, $methods))
            throw new \LogicException('unkown method: '.$method);
        $this->_method = $method;
    }

    public function getResult() {
        return $this->_result;
    }

    public function before() {
    }

    public function after() {
    }

    public function mergeHeaders(array $array) {
        foreach($array as $header => $value) {
            $this->_headers[$header] = $value;
        }
    }
}
