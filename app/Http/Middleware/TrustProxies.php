<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     * Konfigurasikan via .env TRUSTED_PROXIES (misal: "*" atau "127.0.0.1,192.168.100.1").
     *
     * @var array<int, string>|string|null
     */
    protected $proxies;

    /**
     * Resolve trusted proxies secara dinamis dari config agar kompatibel dengan config:cache.
     *
     * @return array<int, string>|string|null
     */
    protected function proxies()
    {
        $configured = config('app.trusted_proxies');

        if (empty($configured)) {
            return $this->proxies;
        }

        if ($configured === '*') {
            return '*';
        }

        return array_values(array_filter(array_map('trim', explode(',', (string) $configured))));
    }

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    protected $headers =
        Request::HEADER_X_FORWARDED_FOR |
        Request::HEADER_X_FORWARDED_HOST |
        Request::HEADER_X_FORWARDED_PORT |
        Request::HEADER_X_FORWARDED_PROTO |
        Request::HEADER_X_FORWARDED_AWS_ELB;
}
