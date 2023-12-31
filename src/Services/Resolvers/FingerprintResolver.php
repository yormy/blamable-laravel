<?php
namespace Yormy\BlamableLaravel\Services\Resolvers;

use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class FingerprintResolver
{
    public static function get(?Request $request = null): ?String
    {
        if (!$request) {
            return null;
        }
        $fingerprint = $request->get(config('blamable.request_fields.browser_fingerprint', 'browser_fingerprint'));

        return $fingerprint;
    }
}
