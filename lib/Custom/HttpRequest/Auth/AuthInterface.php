<?php

namespace Custom\HttpRequest\Auth;

use Custom\HttpRequest\ProviderInterface;

interface AuthInterface
{
    public function set(ProviderInterface $request);
}
