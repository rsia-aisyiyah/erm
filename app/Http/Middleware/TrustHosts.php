<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustHosts as Middleware;

class TrustHosts extends Middleware
{
    /**
     * Get the host patterns that should be trusted.
     *
     * @return array<int, string|null>
     */
    public function hosts()
    {
        return array_values(array_filter([
            $this->allSubdomainsOfApplicationUrl(),
            '^(.+\.)?rsiap\.my\.id$',
            '^(.+\.)?sim\.rsiaaisyiyah\.com$',
            '^localhost$',
            '^127\.0\.0\.1$',
            '^192\.168\.\d{1,3}\.\d{1,3}$',
            '^10\.\d{1,3}\.\d{1,3}\.\d{1,3}$',
        ]));
    }
}
