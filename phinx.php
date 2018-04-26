<?php

require 'vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

return [
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds',
    ],
    'environments' => [
        'default_database' => getenv('APP_ENV'),
        'default_migration_table' => 'phinxlog',
        'testing' => [
            'adapter' => 'mysql',
            'host' => getenv('DB_TESTING_HOST'),
            'name' => getenv('DB_TESTING_DATABASE'),
            'user' => getenv('DB_TESTING_USERNAME'),
            'pass' => getenv('DB_TESTING_PASSWORD'),
            'port' => 3306,
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'local' => [
            'adapter' => 'mysql',
            'host' => getenv('DB_LOCAL_HOST'),
            'name' => getenv('DB_LOCAL_DATABASE'),
            'user' => getenv('DB_LOCAL_USERNAME'),
            'pass' => getenv('DB_LOCAL_PASSWORD'),
            'port' => 3306,
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'production' => [
            'adapter' => 'mysql',
            'host' => getenv('DB_PRODUCTION_HOST'),
            'name' => getenv('DB_PRODUCTION_DATABASE'),
            'user' => getenv('DB_PRODUCTION_USERNAME'),
            'pass' => getenv('DB_PRODUCTION_PASSWORD'),
            'port' => 3306,
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
    ],
];
