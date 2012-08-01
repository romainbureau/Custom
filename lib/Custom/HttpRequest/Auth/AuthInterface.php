<?php

namespace Custom\HttpRequest\Auth;

use Custome\HttpRequest\ProviderInterface;

interface AuthInterface {
    public function set(ProviderInterface $request);
}
