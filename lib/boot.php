<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . "/functions.php";

session_start();

$database = new mysqli("localhost", "zytixon", "discordisstillbetter", "zytixon");

if ($database->connect_error) {
    die("<h1>An error occured connecting to the database. That's sad.</h1><br>" . $database->connect_error);
}
