<?php

// Load Composer autoload
require __DIR__ . '/../vendor/autoload.php';
use Dotenv\Dotenv;

$path = __DIR__ . '/../';

if(!file_exists($path . '.env')){
    die('.env file not found at ' . $path);
}

// Load environment variables from .env file
$dotenv = Dotenv::createImmutable($path);
$dotenv->load();

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

// Yii Framework main file
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

// Load application configuration
$config = require __DIR__ . '/../config/web.php';

// Create and run the Yii application
(new yii\web\Application($config))->run();
