<?php

return [

    /*
     * This host will be used if none is specified
     * when executing the `remote` command.
     */
    'default_host' => 'default',

    /*
     * Here you can define the hosts where the commands should be executed.
     */
    'hosts' => [
        'default' => [
            'host' => env('premium238.web-hosting.com'),

            'port' => env('REMOTE_PORT', 21098),

            'user' => env('onligfbc'),

            /*
             * The package will cd to the given path before executing the given command.
             */
            'path' => env('shop.onlineserviceslab.com'),
        ]
    ],
];
