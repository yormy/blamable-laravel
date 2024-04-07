<?php

namespace Yormy\BlamableLaravel\Models\Traits;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Yormy\BlamableLaravel\Services\Resolvers\FingerprintResolver;
use Yormy\BlamableLaravel\Services\Resolvers\IpResolver;
use Yormy\BlamableLaravel\Services\Resolvers\UserAgentResolver;
use Yormy\BlamableLaravel\Services\Resolvers\UserResolver;

trait useBlamable
{
    public static function bootBlamable()
    {
        static::saving(function ($model) {
            if (! config('blamable.enabled')) {
                return;
            }

            $fields = config('blamable.fields', []);

            $encryptedFields = config('blamable.encryption', []);
            $hashedFields = config('add_hash', []);

            $user = UserResolver::get();

            if (array_key_exists('user_id', $fields)) {
                $keyColum = config('blamable.user_key_column', 'id');
                $model->blamable_user_id = $user->$keyColum;
            }

            if (array_key_exists('user_type', $fields)) {
                $model->blamable_user_type = $user->getMorphClass();
            }

            if (array_key_exists('browser_fingerprint', $fields)) {
                $model->blamable_fingerprint = FingerprintResolver::get();
            }

            if (array_key_exists('ip_address', $fields)) {
                $this->handleIpAddress($model, $encryptedFields, $hashedFields);
            }

            if (array_key_exists('user_agent', $fields)) {
                $this->handleUserAgent($model, $encryptedFields, $hashedFields);
            }

        });
    }

    private static function handleIpAddress($model, $encryptedFields, $hashedFields)
    {
        $ipAddress = IpResolver::get();
        $model->blamable_ip = $ipAddress;

        if (array_key_exists('ip_address', $encryptedFields)) {
            $model->blamable_ip = self::encrypt($ipAddress);
        }

        if (array_key_exists('ip_address', $hashedFields)) {
            $model->blamable_ip_hash = Hash::make($ipAddress);
        }
    }

    private static function handleUserAgent($model, $encryptedFields, $hashedFields)
    {
        $userAgent = UserAgentResolver::getFullAgent(request());
        $model->blamable_user_agent = $userAgent;

        if (array_key_exists('user_agent', $encryptedFields)) {
            $model->blamable_user_agent = self::encrypt($userAgent);
        }

        if (array_key_exists('user_agent', $hashedFields)) {
            $model->blamable_user_agent_hash = Hash::make($userAgent);
        }
    }

    private static function encrypt($value)
    {
        return Crypt::encrypt($value);
    }
}
