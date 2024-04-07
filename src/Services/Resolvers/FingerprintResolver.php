<?php

namespace Yormy\BlamableLaravel\Services\Resolvers;

use Illuminate\Http\Request;

class FingerprintResolver
{
    public static function get(?Request $request = null): ?string
    {
        if (! $request) {
            return null;
        }
        $fingerprint = $request->get(config('blamable.request_fields.browser_fingerprint', 'browser_fingerprint'));

        return $fingerprint;
    }
}
