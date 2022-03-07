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
            'host' => 'premium238.web-hosting.com',

            'port' => 21098,

            'user' => 'onligfbc',

            /*
             * The package will cd to the given path before executing the given command.
             */
            'path' => 'shop.onlineserviceslab.com',
        ]
    ],
];
