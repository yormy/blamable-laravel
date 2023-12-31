<?php

return [

    'enabled' => true,

    /*
    |--------------------------------------------------------------------------
    | Key of user model
    |--------------------------------------------------------------------------
    |
    | If you are not using the 'id' column as a primary key of your user, than you can specify another column
    | ie :
    |   'user_key_column' => 'id'
    |
    */

    'user_key_column' => 'id',

    /*
    |--------------------------------------------------------------------------
    | Recorded fields
    |--------------------------------------------------------------------------
    |
    | Specify the fields you want to record
    | ie :
    |   'encryption' => [
    |       'user_id',
    |       'user_type',
    |       'user_agent',
    |       'browser_fingerprint'
    |   ]
    |
    */

    'fields' => [
            'user_id',
            'user_type',
            'ip_address',
            'user_agent',
            'browser_fingerprint',
    ],

    /*
    |--------------------------------------------------------------------------
    | Encryption
    |--------------------------------------------------------------------------
    |
    | Specify the fields you want to encrypt
    | To encrypt the ip address:
    | ie :
    |   'encryption' => [
    |       'ip_address'
    |   ]
    |
    */

    'encryption' => [
        'ip_address'
    ],

    /*
    |--------------------------------------------------------------------------
    | Add hashes
    |--------------------------------------------------------------------------
    |
    | When you encrypt fields they no longer can be queried at the database level.
    | If you still want to search the database, add hashes
    | ie :
    |   'add_hash' => [
    |       'ip_address'
    |   ]
    |
    */

    'add_hash' => [
        'ip_address'
    ],

    /*
    |--------------------------------------------------------------------------
    | Frontend blaming
    |--------------------------------------------------------------------------
    |
    | If you have a browser_fingerprint, you can store that, just specify the request field that hold this value
    | You need to be generate the browser fingerprint yourself on the frontend and pass it into the request youself
    | ie :
    |   'request_fields' => [
    |       'browser_fingerprint'
    |   ]
    |
    */

    'request_fields' => [
        'browser_fingerprint' => 'browser_fingerprint'
    ]


];
