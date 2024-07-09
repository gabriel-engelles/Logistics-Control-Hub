<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=' . ($_ENV['DB_HOST'] ?? 'localhost') . ';dbname=' . ($_ENV['DB_NAME'] ?? 'Enter your database name'),
    'username' => $_ENV['DB_USER'] ?? 'Enter your database username',
    'password' => $_ENV['DB_PASS'] ?? 'Enter your database password',
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
