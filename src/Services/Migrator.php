<?php

namespace Yormy\BlamableLaravel\Services;

class Migrator
{
    public static function run($table, $after = null)
    {
        $fields = config('blamable.fields', []);
        $encryptedFields = config('blamable.encryption', []);
        $hashedFields = config('add_hash', []);


        if (array_key_exists('user_id', $fields)) {
            $idColumn = $table->unsignedBigInteger('blamable_user_id')->nullable();
            if ($after) {
                $idColumn->after($after);
            }
            $after = 'blamable_user_id';
        }

        if (array_key_exists('user_type', $fields)) {
            $table->string('blamable_user_type')->nullable()->after($after);
            $after = 'blamable_user_type';
        }


        if (array_key_exists('ip_address', $fields)) {
            if (array_key_exists('ip_address', $encryptedFields)) {
                $table->string('blamable_ip', 1024)->nullable()->after($after);
            } else {
                $table->string('blamable_ip', 30)->nullable()->after($after);
            }
            $after = 'blamable_ip';

            if (array_key_exists('ip_address', $hashedFields)) {
                $table->string('blamable_ip_hash', 100)->nullable()->after($after);
                $after = 'blamable_ip_hash';
            }
        }

        if (array_key_exists('user_agent', $fields)) {
            if (array_key_exists('user_agent', $encryptedFields)) {
                $table->string('blamable_user_agent', 1024)->nullable()->after($after);
            } else {
                $table->string('blamable_user_agent', 200)->nullable();
            }
            $after = 'blamable_user_agent';

            if (array_key_exists('user_agent', $hashedFields)) {
                $table->string('blamable_user_agent_hash', 100)->nullable()->after($after);
                $after = 'blamable_user_agent_hash';
            }
        }

        if (array_key_exists('browser_fingerprint', $fields)) {
            $table->string('blamable_fingerprint')->nullable()->after($after);
        }
    }
}
