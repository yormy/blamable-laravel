<?php
namespace Yormy\BlamableLaravel\Services\Resolvers;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class UserResolver
{
    public static function get(): Authenticatable
    {
        return Auth::user();
    }
}
