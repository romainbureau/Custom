<?php

namespace Custom\HttpRequest\Auth;

use Custom\HttpRequest\ProviderInterface;

use Custom\HttpRequest\Provider\Curl;
use Custom\HttpRequest\Provider\FileGetContents;

class HttpBasic implements AuthInterface {

    private $_auth;

    public function __construct($auth = null) {
        if(!$auth)
            throw new \Exception('auth argument missing');

        $this->_auth = base64_encode($auth);
    }

    public function set(ProviderInterface $request) {
        $header = array('Authorization' => 'Basic '.$this->_auth);
        $request->mergeHeaders($header);
    }
}
