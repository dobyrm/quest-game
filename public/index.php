<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../var/config.php';
require_once __DIR__ . '/../route/index.php';