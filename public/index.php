<?php

// Register the Composer autoloader...
if(file_exists(__DIR__ . '/../vendor/autoload.php')) {
    require __DIR__ . '/../vendor/autoload.php';
}


// Bootstrap DOA and handle the request...
$app = require_once __DIR__ . '/../bootstrap/app.php';

