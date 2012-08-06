<?php

namespace Custom\HttpRequest;

use Custom\HttpRequest\Auth\AuthInterface;

class Request {

    public function __construct(ProviderInterface $request, AuthInterface $auth = null) {
        $this->_request = $request;
        $this->_auth = $auth;
    }

    public function setUrl($url) {
        $this->_request->setUrl($url);
    }

    public function setHeaders(array $headers = array()) {
        $this->_request->setHeaders($headers);
    }

    public function setMethod($method) {
        $this->_request->setMethod($method);
    }

    public function setData($data) {
        $this->_request->setData($data);
    }

    public function request() {
        $this->_request->before();

        if($this->_auth) {
            $this->_auth->set($this->_request);
        }

        $this->_request->run();
        $this->_request->after();
    }

    public function getResult() {
        return $this->_request->getResult();
    }

    public function __toString() {
        var_dump($this);
    }
} 
