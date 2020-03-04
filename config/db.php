<?php

return [
    'entity_paths' => [
        __DIR__ . '/../src/Entity/'
    ],
    'dev_mode'     => true,
    'db_params'    => [
        'host'     => 'pgsql_taskholder',
        'port'     => '5432',
        'driver'   => 'pdo_pgsql',
        'user'     => 'taskholder_user',
        'password' => 'postgres1234',
        'dbname'   => 'taskholder_db'
    ]
];