<?php

return [
    'default' => 'default',

    /**
     * default config.
     */
    'defaults' => [],

    'clients' => [
        'default' => [
            'driver'       => 'ots',
            'connection'   => 'ots',
            'table'        => 'oauth_users',
            'openid_index' => 'oauth_users_openid_index',
        ],
    ],
];
