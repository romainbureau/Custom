<?php

namespace Custom\HttpRequest\Auth;

use Custom\HttpRequest\ProviderInterface;

class Hmac implements AuthInterface {

    private $_encoder = 'sha256';
    private $_consumer;
    private $_private_key;

    public function __construct($params = array()) {
        $this->_consumer = $params['consumer'];
        $this->_private_key = $params['private_key'];
        if(isset($params['encoder']))
            $this->_encoder = $params['encoder'];
    }

    public function set(ProviderInterface $request) {
        $ts = time();
        $hmac = hash_hmac($this->_encoder, $this->_consumer.$request->getData().$ts, $this->_private_key);
        $_tmp = array(
            'ts' => $ts,
            'consumer' => $this->_consumer,
            'token' => base64_encode($hmac),
        );

        $request->setUrl($request->getUrl().'?'.http_build_query($_tmp));
    }
}
