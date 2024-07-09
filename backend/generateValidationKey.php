<?php

// Path to Yii project directory
$projectDir = __DIR__;

// Include Composer autoload
require $projectDir . '/vendor/autoload.php';

// Include Yii application
require $projectDir . '/vendor/yiisoft/yii2/Yii.php';

// Configure the Yii application
$config = require $projectDir . '/config/web.php';
$application = new yii\web\Application($config);

// Generate a random key
$key = \Yii::$app->security->generateRandomString(32);

// File path for the .env file
$envFilePath = $projectDir . '/.env';

// Check if the .env file already exists
if (file_exists($envFilePath)) {
    // Read the current contents of the .env file
    $currentContent = file_get_contents($envFilePath);

    // Prepare the new key entry
    $newEntry = 'COOKIE_VALIDATION_KEY=' . $key;

    // Prepare comments
    $commentAbove = "# DB CONNECTION\n"
                    ."DB_HOST=\n"
                    ."DB_NAME=\n"
                    ."DB_USER=\n"
                    ."DB_PASS=\n"
                    ."#\n"
                    ."# MAILER CONFIG\n"
                    ."M_SCHEME=\n"
                    ."M_HOST=\n"
                    ."M_USER=\n"
                    ."M_PASS=\n"
                    ."M_PORT=\n"
                    ."M_CONFIG_1=#email\n"
                    ."M_CONFIG_2=#project name\n"
                    ."#\n"
                    ."# NEW COOKIE_VALIDATION_KEY";
    $commentBelow = "#";

    // Check if the COOKIE_VALIDATION_KEY already exists in the file
    if (strpos($currentContent, 'COOKIE_VALIDATION_KEY=') === false) {
        // Append the comments, new key, and comments below to the end of the file
        file_put_contents($envFilePath, $commentAbove . PHP_EOL . $newEntry . PHP_EOL . $commentBelow . PHP_EOL, FILE_APPEND | LOCK_EX);
    } else {
        // If COOKIE_VALIDATION_KEY already exists, do not update
        echo "COOKIE_VALIDATION_KEY already exists in .env file." . PHP_EOL;
    }
} else {
    // If .env file doesn't exist, create it and write the key with comments
    $content = "# Environment variables configuration" . PHP_EOL
             . "# Please do not remove this section" . PHP_EOL
             . PHP_EOL
             . $commentAbove . PHP_EOL
             . 'COOKIE_VALIDATION_KEY=' . $key . PHP_EOL
             . $commentBelow . PHP_EOL;
    file_put_contents($envFilePath, $content);
}

echo "Key generated and saved successfully!" . PHP_EOL;
