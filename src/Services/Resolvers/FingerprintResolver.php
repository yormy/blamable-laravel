<?php

declare(strict_types=1);

namespace Yormy\BlamableLaravel\Services\Resolvers;

use Illuminate\Http\Request;

class FingerprintResolver
{
    public static function get(?Request $request = null): ?string
    {
        if (! $request) {
            return null;
        }
        return $request->get(config('blamable.request_fields.browser_fingerprint', 'browser_fingerprint'));
    }
}
