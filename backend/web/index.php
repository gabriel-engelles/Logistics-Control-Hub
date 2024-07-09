<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

// Load Composer autoload
require __DIR__ . '/../vendor/autoload.php';

// Load environment variables from .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Yii Framework main file
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

// Load application configuration
$config = require __DIR__ . '/../config/web.php';

// Create and run the Yii application
(new yii\web\Application($config))->run();
