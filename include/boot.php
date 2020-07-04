<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . "/functions.php";
$includedconfig = include __DIR__ . "/../config.php";
if (!$includedconfig) {
  die("<h1>Couldn't load the config file.</h1>");
}

session_start();

$database = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ($database->connect_error) {
    die("<h1>An error occured connecting to the database :</h1><br>" . $database->connect_error);
}
