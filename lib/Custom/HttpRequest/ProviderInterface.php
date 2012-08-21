<?php

namespace Custom\HttpRequest;

interface ProviderInterface
{
    public function setUrl($url);
    public function getUrl();
    public function setAuth($auth);
    public function setHeaders(array $headers);
    public function setMethod($method);
    public function setData($data);
    public function getData();
    public function getResult();
    public function before();
    public function run();
    public function after();
}
