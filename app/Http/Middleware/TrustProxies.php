<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Symfony\Component\HttpFoundation\Request;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array|string|null
     */
    protected $proxies = null;

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    protected $headers = Request::HEADER_X_FORWARDED_FOR | Request::HEADER_X_FORWARDED_HOST | Request::HEADER_X_FORWARDED_PORT | Request::HEADER_X_FORWARDED_PROTO | Request::HEADER_X_FORWARDED_PREFIX | Request::HEADER_X_FORWARDED_AWS_ELB;

    public function __construct()
    {
        // Allow configuring trusted proxies via the TRUSTED_PROXIES env variable.
        // Example: TRUSTED_PROXIES=127.0.0.1,10.0.0.0/8
        $env = env('TRUSTED_PROXIES', null);
        if ($env) {
            $this->proxies = is_string($env) ? array_map('trim', explode(',', $env)) : $env;
        }
    }
}
